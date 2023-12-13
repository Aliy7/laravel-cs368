
<div class="flex items-center space-x-4">
  <!-- Like Emoji (Heart) with Count -->
  <span wire:click="toggleLike" class="cursor-pointer text-2xl">
      {{ $isLiked ? '❤️' : '🤍' }}
  </span>
  <span class="text-lg">{{ $likesCount }} Likes</span>
  
  <!-- Dislike Emoji (Thumb Down) with Count -->
  <span wire:click="toggleDislike" class="cursor-pointer text-lg">
      {{ $isDisliked ? '👎' : '👍' }}
  </span>
  <span class="text-lg">{{ $dislikesCount }} Dislikes</span>
</div>
