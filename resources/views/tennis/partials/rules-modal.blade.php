{{-- Rules gate, sliced from registration.html. The agree button stays
     disabled until [data-rules-body] is scrolled to the end (main.js), and the
     check is re-armed on every shown.bs.modal. Server-side the FormRequest must
     still validate accept_rules => ['accepted']; this is a courtesy, not a
     control. --}}
<div class="modal fade" id="rulesModal" tabindex="-1" aria-labelledby="rulesModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content rules">
      <div class="modal-header rules__head">
        <div>
          <span class="eyebrow mb-1">Jaya Tennis Championship 2026</span>
          <h2 class="modal-title h4 mb-0" id="rulesModalLabel">Rules &amp; code of conduct</h2>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="batik-strip"></div>

      <div class="modal-body rules__body" data-rules-body tabindex="0">
        <p class="lede mb-4">
          These regulations are issued by the tournament committee under the rules of tennis and
          apply to every player, captain, coach and guest for the duration of the championship.
        </p>
            <section class="rules__section">
              <span class="rules__no">I</span>
              <h3 class="h5">Eligibility</h3>
              <ol class="rules__list">
                <li>Entry is open to players holding a current national federation licence, or to unlicensed players who register a day licence with the tournament office before their first match.</li>
                <li>Junior entrants must be under eighteen on the first day of the championship and must supply written consent from a parent or guardian.</li>
                <li>A player may represent one club only for the duration of the championship. Club transfers registered after 5 October do not take effect until the following season.</li>
              </ol>
            </section>
            <section class="rules__section">
              <span class="rules__no">II</span>
              <h3 class="h5">Entries and seeding</h3>
              <ol class="rules__list">
                <li>Entries close at 23:59 WIB on 28 September, or earlier if a draw fills. A draw is full at thirty-two players for singles, sixteen pairs for doubles and eight clubs for the team event.</li>
                <li>Seeding follows the national ranking list published two weeks before the first ball. The referee may seed an unranked player on demonstrated form, and will record the reason in the tournament log.</li>
                <li>The draw is made in public at the tournament office on 5 October and is final once signed by the referee.</li>
              </ol>
            </section>
            <section class="rules__section">
              <span class="rules__no">III</span>
              <h3 class="h5">Format and scoring</h3>
              <ol class="rules__list">
                <li>Singles and doubles are best of three tie-break sets. A championship tie-break to ten points replaces the third set in all doubles draws.</li>
                <li>Doubles are played with no-ad scoring. At deuce the receiving pair chooses the side of the next point.</li>
                <li>A club tie is two singles rubbers and one doubles rubber. A club leading two rubbers to nil plays the third rubber as a dead rubber unless both captains agree to concede it.</li>
              </ol>
            </section>
            <section class="rules__section">
              <span class="rules__no">IV</span>
              <h3 class="h5">Punctuality and default</h3>
              <ol class="rules__list">
                <li>Players are to present themselves at the tournament office fifteen minutes before the scheduled start. A match is called three times over the public address.</li>
                <li>A player not on court within five minutes of the third call forfeits the first game, and one further game for each subsequent minute. At fifteen minutes the match is defaulted.</li>
                <li>The referee may waive a default where the delay is caused by an earlier match overrunning, by transport disruption, or by a medical matter reported before the call.</li>
              </ol>
            </section>
            <section class="rules__section">
              <span class="rules__no">V</span>
              <h3 class="h5">Conduct</h3>
              <ol class="rules__list">
                <li>Players, captains, coaches and guests are expected to conduct themselves with courtesy toward opponents, officials, ground staff and spectators at all times.</li>
                <li>Audible obscenity, visible obscenity, racquet or ball abuse, verbal or physical abuse, and unsportsmanlike conduct carry, in order: a warning, a point penalty, a game penalty, and default.</li>
                <li>Coaching from off court is permitted between points and at changeovers provided it does not delay play or disturb the opponent. Coaching during a point is a code violation.</li>
                <li>Any conduct that brings the championship into disrepute may be referred by the referee to the tournament committee, which may suspend a player or a club for the remainder of the event.</li>
              </ol>
            </section>
            <section class="rules__section">
              <span class="rules__no">VI</span>
              <h3 class="h5">Dress and equipment</h3>
              <ol class="rules__list">
                <li>Predominantly white or club-registered playing dress is required on all courts. Club colours are permitted on trim, sleeves and collars.</li>
                <li>Shoes must have a smooth or lightly patterned sole. Studded, ridged or dark-soled shoes are not permitted on grass under any circumstances.</li>
                <li>Advertising on clothing is limited to two placements, neither exceeding twenty-six square centimetres.</li>
              </ol>
            </section>
            <section class="rules__section">
              <span class="rules__no">VII</span>
              <h3 class="h5">Officials and appeals</h3>
              <ol class="rules__list">
                <li>The referee is the final authority on all questions of tournament regulation. The chair umpire is the final authority on all questions of fact arising during a match.</li>
                <li>A player may appeal a question of regulation to the referee, whose decision is final and is not subject to further appeal.</li>
                <li>Where no chair umpire is appointed, players call their own side of the net and are expected to give the benefit of any doubt to the opponent.</li>
              </ol>
            </section>
            <section class="rules__section">
              <span class="rules__no">VIII</span>
              <h3 class="h5">Withdrawal, refunds and medical</h3>
              <ol class="rules__list">
                <li>A withdrawal notified in writing before 1 October is refunded in full. No refund is made after that date, save on production of a medical certificate.</li>
                <li>One medical time-out of three minutes is permitted per treatable condition, taken at a changeover where practicable.</li>
                <li>A player who retires from a match may not enter a further draw at the same championship without clearance from the tournament doctor.</li>
              </ol>
            </section>
            <section class="rules__section">
              <span class="rules__no">IX</span>
              <h3 class="h5">Data, photography and results</h3>
              <ol class="rules__list">
                <li>Entry data is held by the tournament office for the running of the championship and the maintenance of the ranking list, and is not passed to third parties for marketing.</li>
                <li>Results, including player names, club and scores, are published on the tournament site and remain in the public record.</li>
                <li>Photography and filming take place throughout the grounds. A player who does not consent to the publication of their image should notify the tournament office in writing before their first match.</li>
              </ol>
            </section>
        <div class="rule--gilt" role="presentation"><span></span></div>
        <p class="text-soft small mb-0">
          Issued by the tournament committee, Senayan Courts, Yogyakarta &middot; revision 12, August 2026.
        </p>
      </div>

      <div class="modal-footer rules__foot">
        <span class="rules__hint" data-rules-hint>Scroll to the end to continue &darr;</span>
        <button type="button" class="btn btn-outline-ink" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-ink" data-rules-agree disabled>I have read and agree</button>
      </div>
    </div>
  </div>
</div>
