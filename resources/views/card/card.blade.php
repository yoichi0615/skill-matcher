
<div class="card m-3 p-content-card plan-card">
  <a href="{{route('post.show', ['id' => $post->id])}}">     
    <div class="card-body">
      <div class="eye_catch">
        {{ $post->user->name }}
      </div>
      @foreach ($post->tags as $tag)
        @if ($loop->first)
        <div class="card-body pt-0 pb-4 pl-3">
          <div class="card-text line-height">
        @endif
        <a href="{{ route('tags.show', ['name' => $tag->name]) }}" class="border p-1 mr-1 mt-1 text-muted">
          {{ $tag->hash_tag }}
        </a>
        @if ($loop->last)
          </div>
        </div>
        @endif
      @endforeach
      <div class="inner_card">
        <div class="plan_text">
          {{ $post->summary }}</br>
          ここに説明文とユーザーの写真、評価などが入ります。(下部)
        </div>
      </div>
    </div>
  </a>
</div>