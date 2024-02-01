<div style="width: 500px; margin: 0 auto; padding: 15px; text-align: center">
    @if(isset($data['status']) && $data['status'] == 1)
        <h2>Bài viết "{{ $data['title'] }}" của bạn đã được phê duyệt</h2>
    @else
        <h2>Bài viết "{{ $data['title'] }}" của bạn bị từ chối</h2>
    @endif
</div>
