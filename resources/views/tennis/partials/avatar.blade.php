{{--
    Squad avatar for the compact list: the uploaded portrait, or the illustrated
    stand-in zoomed to the figure's upper body — at this size the full card
    would be an unreadable blob.

    Expects $member (EventTeamMemberModel).
--}}
<span class="member-avatar">
  <img src="{{ $member->photo_url ?: $member->placeholder_photo_url }}"
       alt="{{ $member->photo_url ? $member->name : '' }}"
       class="{{ $member->photo_url ? '' : 'member-avatar__illustration' }}"
       loading="lazy">
</span>
