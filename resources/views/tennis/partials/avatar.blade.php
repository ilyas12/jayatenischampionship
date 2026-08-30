{{--
    Squad avatar: the uploaded portrait, or a silhouette when there is none.

    The silhouette is inline SVG rather than a placeholder file — no extra
    request, it scales to whatever size the caller's CSS sets, and it takes its
    colour from the surrounding text.

    Expects $member (EventTeamMemberModel).
--}}
<span class="member-avatar">
  @if ($member->photo_url)
    <img src="{{ $member->photo_url }}" alt="{{ $member->name }}" loading="lazy">
  @else
    <svg class="member-avatar__silhouette" viewBox="0 0 40 40" aria-hidden="true" focusable="false">
      <circle cx="20" cy="14.5" r="6.6"/>
      <path d="M6.5 36c0-7.1 6-12.2 13.5-12.2S33.5 28.9 33.5 36z"/>
    </svg>
  @endif
</span>
