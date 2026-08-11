<!DOCTYPE html>
<html lang="en">
<head>
    @include('templates.parts.headv2')
    <!-- for Facebook -->
    <meta property="og:title" content="{{ $underlying_detail->underlying_title }}" />
    <meta property="og:type" content="article" />
    <meta property="og:image" content="{{ URL::asset('resources/assets/uploads/news_and_events/'.$underlying_detail->underlying_img_banner) }}" />
    <meta property="og:url" content="{{ url('underlying') }}" />
    <meta property="og:description" content="{{ $underlying_detail->underlying_title }}" />

    <!-- for Twitter -->
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="{{ $underlying_detail->underlying_title }}" />
    <meta name="twitter:description" content="{{ $underlying_detail->underlying_title }}" />
    <meta name="twitter:image" content="{{ URL::asset('resources/assets/uploads/news_and_events/'.$underlying_detail->underlying_img_banner) }}" />
</head>
<body>
    @include('templates.parts.headerv2')

    <section class="page-section" style="background: #e5dede;">
        <div class="container custom-container-md">
            <div class="row">
                <div class="title-section">
                    <div class="title"><h4>Underlying</h4></div>
                    <span class="small-border"></span>
                </div>
                <div class="news-section">
                    <div class="news-detail-content col-md-12">
                        <div class="img-news">
                            <img src="{{ URL::asset('resources/assets/uploads/news_and_events/'.$underlying_detail->underlying_img_banner) }}" class="img-responsive">
                        </div>

                        <div class="title-news">
                            <h3>{{ $underlying_detail->underlying_title }}</h3>
                            <span class="title-news-bordered"></span>
                        </div>
                        <div class="news-detail-description" style="padding-top:0px">
                             
                            <div class="document-list">
                              <a
                                href="{{ URL::asset($underlying_detail->underlying_individual_jkt_files) }}"
                                class="document-item"
                                title="{{ $underlying_detail->underlying_individual_jkt_files }}"
                                data-tooltip="{{ $underlying_detail->underlying_individual_jkt_files }}"
                                download
                              >
                                <span class="document-icon" aria-hidden="true">
                                  <svg viewBox="0 0 24 24" fill="none">
                                    <path
                                      d="M6 2.75h8l4 4V21.25H6V2.75Z"
                                      stroke="currentColor"
                                      stroke-width="1.5"
                                      stroke-linejoin="round"
                                    />
                                    <path
                                      d="M14 2.75v4h4"
                                      stroke="currentColor"
                                      stroke-width="1.5"
                                      stroke-linejoin="round"
                                    />
                                    <path
                                      d="M8.5 16.5h7"
                                      stroke="currentColor"
                                      stroke-width="1.5"
                                      stroke-linecap="round"
                                    />
                                    <path
                                      d="M12 10v4m0 0-2-2m2 2 2-2"
                                      stroke="currentColor"
                                      stroke-width="1.5"
                                      stroke-linecap="round"
                                      stroke-linejoin="round"
                                    />
                                  </svg>
                                </span>
                            
                                <span class="document-content">
                                  <span class="document-title">FORM DI ATAS THRESHOLD</span>
                                  <span class="document-meta">INDIVIDU Cb JKT</span>
                                </span>
                            
                                <!--<span class="download-text">Download</span>-->
                              </a>
                            
                              <a
                                href="{{ URL::asset($underlying_detail->underlying_individual_sby_files) }}"
                                class="document-item"
                                title="{{ $underlying_detail->underlying_individual_sby_files }}"
                                data-tooltip="{{ $underlying_detail->underlying_individual_sby_files }}"
                                download
                              >
                                <span class="document-icon" aria-hidden="true">
                                  <svg viewBox="0 0 24 24" fill="none">
                                    <path
                                      d="M6 2.75h8l4 4V21.25H6V2.75Z"
                                      stroke="currentColor"
                                      stroke-width="1.5"
                                      stroke-linejoin="round"
                                    />
                                    <path
                                      d="M14 2.75v4h4"
                                      stroke="currentColor"
                                      stroke-width="1.5"
                                      stroke-linejoin="round"
                                    />
                                    <path
                                      d="M8.5 16.5h7"
                                      stroke="currentColor"
                                      stroke-width="1.5"
                                      stroke-linecap="round"
                                    />
                                    <path
                                      d="M12 10v4m0 0-2-2m2 2 2-2"
                                      stroke="currentColor"
                                      stroke-width="1.5"
                                      stroke-linecap="round"
                                      stroke-linejoin="round"
                                    />
                                  </svg>
                                </span>
                            
                                <span class="document-content">
                                  <span class="document-title">FORM DI ATAS THRESHOLD</span>
                                  <span class="document-meta">INDIVIDU Cb SBY</span>
                                </span>
                            
                                <!--<span class="download-text">Download</span>-->
                              </a>
                              <a
                                href="{{ URL::asset($underlying_detail->underlying_corporate_jkt_files) }}"
                                class="document-item"
                                title="{{ $underlying_detail->underlying_corporate_jkt_files }}"
                                data-tooltip="{{ $underlying_detail->underlying_corporate_jkt_files }}"
                                download
                              >
                                <span class="document-icon" aria-hidden="true">
                                  <svg viewBox="0 0 24 24" fill="none">
                                    <path
                                      d="M6 2.75h8l4 4V21.25H6V2.75Z"
                                      stroke="currentColor"
                                      stroke-width="1.5"
                                      stroke-linejoin="round"
                                    />
                                    <path
                                      d="M14 2.75v4h4"
                                      stroke="currentColor"
                                      stroke-width="1.5"
                                      stroke-linejoin="round"
                                    />
                                    <path
                                      d="M8.5 16.5h7"
                                      stroke="currentColor"
                                      stroke-width="1.5"
                                      stroke-linecap="round"
                                    />
                                    <path
                                      d="M12 10v4m0 0-2-2m2 2 2-2"
                                      stroke="currentColor"
                                      stroke-width="1.5"
                                      stroke-linecap="round"
                                      stroke-linejoin="round"
                                    />
                                  </svg>
                                </span>
                            
                                <span class="document-content">
                                  <span class="document-title">FORM DI ATAS THRESHOLD</span>
                                  <span class="document-meta">CORPORATE Cb JKT</span>
                                </span>
                            
                                <!--<span class="download-text">Download</span>-->
                              </a>
                              <a
                                href="{{ URL::asset($underlying_detail->underlying_corporate_jkt_files) }}"
                                class="document-item"
                                title="{{ $underlying_detail->underlying_corporate_jkt_files }}"
                                data-tooltip="{{ $underlying_detail->underlying_corporate_jkt_files }}"
                                download
                              >
                                <span class="document-icon" aria-hidden="true">
                                  <svg viewBox="0 0 24 24" fill="none">
                                    <path
                                      d="M6 2.75h8l4 4V21.25H6V2.75Z"
                                      stroke="currentColor"
                                      stroke-width="1.5"
                                      stroke-linejoin="round"
                                    />
                                    <path
                                      d="M14 2.75v4h4"
                                      stroke="currentColor"
                                      stroke-width="1.5"
                                      stroke-linejoin="round"
                                    />
                                    <path
                                      d="M8.5 16.5h7"
                                      stroke="currentColor"
                                      stroke-width="1.5"
                                      stroke-linecap="round"
                                    />
                                    <path
                                      d="M12 10v4m0 0-2-2m2 2 2-2"
                                      stroke="currentColor"
                                      stroke-width="1.5"
                                      stroke-linecap="round"
                                      stroke-linejoin="round"
                                    />
                                  </svg>
                                </span>
                            
                                <span class="document-content">
                                  <span class="document-title">FORM DI ATAS THRESHOLD</span>
                                  <span class="document-meta">CORPORATE Cb SBY</span>
                                </span>
                            
                                <!--<span class="download-text">Download</span>-->
                              </a>
                            </div>
                           
                        </div>
                       
                    </div><!--news-detail-content-->
                </div><!--news-section-->

            </div>
        </div><!--row-->
        </div><!--container-->
    </section>

    @include('templates.parts.footerv2')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#news").addClass("active");
        });
    </script>
    <style>
.document-list {
  display: flex;
  gap: 8px;
  width: 100%;
}

.document-item {
  display: flex;
  align-items: center;
  gap: 12px;
  width: 50%;
  padding: 10px;
  border: 1px solid #e3e3e3;
  border-radius: 8px;
  background: #ffffff;
  color: #1f1f1f;
  text-decoration: none;
  transition:
    border-color 0.2s ease,
    box-shadow 0.2s ease,
    transform 0.2s ease;
}

.document-item:hover {
  border-color: #c62828;
  box-shadow: 0 6px 20px rgb(0 0 0 / 8%);
  transform: translateY(-2px);
}

.document-icon {
  display: flex;
  align-items: center;
  justify-content: center;
  flex: 0 0 48px;
  width: 48px;
  height: 48px;
  border-radius: 8px;
  background: #fff1f1;
  color: #c62828;
}

.document-icon svg {
  width: 28px;
  height: 28px;
}

.document-content {
  display: flex;
  flex: 1;
  flex-direction: column;
  gap: 4px;
  min-width: 0;
}

.document-title {
  overflow: hidden;
  font-size: 14px;
  font-weight: 600;
  text-overflow: ellipsis;
  white-space: nowrap;
}

.document-meta {
  color: #757575;
  font-size: 12px;
}

.download-text {
  color: #c62828;
  font-size: 11px;
  font-weight: 600;
}

/* ---------- Tooltip ---------- */

.document-item::after {
  content: attr(data-tooltip);

  position: absolute;
  left: 50%;
  bottom: calc(100% + 10px);

  transform: translateX(-50%) translateY(6px);

  background: #222;
  color: #fff;

  padding: 8px 10px;
  border-radius: 6px;

  font-size: 12px;
  white-space: nowrap;

  opacity: 0;
  visibility: hidden;

  transition: .2s ease;
  pointer-events: none;

  z-index: 999;
}

.document-item::before {
  content: "";

  position: absolute;
  left: 50%;
  bottom: calc(100% + 4px);

  transform: translateX(-50%) translateY(6px);

  border: 6px solid transparent;
  border-top-color: #222;

  opacity: 0;
  visibility: hidden;

  transition: .2s ease;
}

.document-item:hover::after,
.document-item:hover::before {
  opacity: 1;
  visibility: visible;
  transform: translateX(-50%) translateY(0);
}

@media (max-width: 600px) {
  .document-item {
    padding: 14px;
  }

  .download-text {
    display: none;
  }
}

/* Tablet */
@media (max-width: 768px) {
  .document-list {
    flex-wrap: wrap;
    gap: 12px;
  }

  .document-item {
    width: 100%;
  }
}

/* Mobile */
@media (max-width: 480px) {
  .document-list {
    flex-direction: column;
    gap: 10px;
  }

  .document-item {
    width: 100%;
    padding: 12px;
    gap: 10px;
  }

  .document-icon {
    width: 40px;
    height: 40px;
    flex: 0 0 40px;
  }

  .document-title {
    font-size: 14px;
  }

  .document-description {
    font-size: 12px;
  }
}
    </style>
</body>
</html>