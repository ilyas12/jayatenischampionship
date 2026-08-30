{{--
    Squad avatar: the uploaded portrait, or a silhouette when there is none.

    Shares the squad card's tennis-player silhouette so the two never drift
    apart; the disc simply shows it smaller.

    Expects $member (EventTeamMemberModel).
--}}
<span class="member-avatar">
  @if ($member->photo_url)
    <img src="{{ $member->photo_url }}" alt="{{ $member->name }}" loading="lazy">
  @else
    @include('tennis.partials.silhouette')
  @endif
</span>
