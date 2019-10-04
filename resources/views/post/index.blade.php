@section('content')
    @if ($post->image_path)
      <!-- 画像を表示 -->
      <img src="{{ $post->image_path }}">
    @endif
