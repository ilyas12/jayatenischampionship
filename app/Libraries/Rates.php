<?php

namespace terre\Libraries;

use Cache;
use DB;
use Log;

class Rates
{
    const CACHE_KEY = 'exchange_rates';
    const CACHE_MINUTES = 10;

    /**
     * Return complete exchange data.
     */
    public function all()
    {
        if (Cache::has(self::CACHE_KEY))
        {
            return Cache::get(self::CACHE_KEY);
        }

        $url = $this->getSheetUrl();

        if (!$url)
        {
            return array(
                'information' => array(),
                'rates' => array(),
            );
        }

        $csv = $this->download($url);

        if ($csv === false)
        {
            return array(
                'information' => array(),
                'rates' => array(),
            );
        }

        $result = $this->parse($csv);

        Cache::put(self::CACHE_KEY, $result, self::CACHE_MINUTES);

        return $result;
    }

    /**
     * First N currencies.
     */
    public function top($limit = 5)
    {
        $result = $this->all();

        $result['rates'] = array_slice($result['rates'], 0, $limit, true);

        return $result;
    }

    /**
     * Find one currency.
     */
    public function find($currency)
    {
        $result = $this->all();

        $currency = strtoupper($currency);

        return isset($result['rates'][$currency])
            ? $result['rates'][$currency]
            : null;
    }

    protected function getSheetUrl()
    {
        $config = DB::table('config')
            ->where('name', '=', 'rates_url')
            ->first();

        return $config ? $config->value : false;
    }

    protected function download($url)
    {
        $ch = curl_init();

        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_TIMEOUT => 20,
            CURLOPT_SSL_VERIFYPEER => false,
        ));

        $csv = curl_exec($ch);

        if ($csv === false)
        {
            Log::error(curl_error($ch));
            curl_close($ch);

            return false;
        }

        curl_close($ch);

        return $csv;
    }

    protected function parse($csv)
    {
        $handle = fopen('php://temp', 'r+');
    
        fwrite($handle, $csv);
        rewind($handle);
    
        $information = array(
            'information' => '',
            'update_at'   => '',
        );
    
        $rates = array();
        $index = 0;
    
        while (($data = fgetcsv($handle)) !== false)
        {
            /*
             * Information row
             *
             * Column 1 = information
             * Column 3 = update date
             */
            if ($index == 2)
            {
                $information = array(
                    'information' => isset($data[1])
                        ? strtoupper(trim($data[1]))
                        : '',
    
                    'update_at' => isset($data[3])
                        ? trim($data[3])
                        : '',
                );
    
                $index++;
                continue;
            }
    
            /*
             * Currency rows start after row index 4.
             */
            if ($index > 3 && count($data) >= 3)
            {
                $currency = strtoupper(trim($data[1]));
    
                if (
                    $currency != '' &&
                    $currency != 'RATES UPDATES' &&
                    preg_match('/^[A-Z0-9]{3,5}$/', $currency)
                ) {
                    $rates[$currency] = array(
                        'currency'  => $currency,
                        'flag'      => $this->getFlag($currency),
                        'jakarta'   => trim($data[2]),
                        'surabaya'  => trim($data[3]),
                    );
                }
            }
    
            $index++;
        }
    
        fclose($handle);
    
        return array(
            'information' => $information,
            'rates'       => $rates,
        );
    }
    
    protected function getFlag($currency)
    {
        $flags = array(
            'USD'  => '🇺🇸',
            'SGD'  => '🇸🇬',
            'SGD2' => '🇸🇬',
            'MYR'  => '🇲🇾',
            'JPY'  => '🇯🇵',
            'WON'  => '🇰🇷',
            'KRW'  => '🇰🇷',
            'THB'  => '🇹🇭',
            'AUD'  => '🇦🇺',
            'EURO' => '🇪🇺',
            'EUR'  => '🇪🇺',
            'GBP'  => '🇬🇧',
            'AED'  => '🇦🇪',
            'CAD'  => '🇨🇦',
            'HKD'  => '🇭🇰',
            'NTD'  => '🇹🇼',
            'SAR'  => '🇸🇦',
            'BND'  => '🇧🇳',
            'VND'  => '🇻🇳',
        );
    
        return isset($flags[$currency]) ? $flags[$currency] : '🏳️';
    }
}