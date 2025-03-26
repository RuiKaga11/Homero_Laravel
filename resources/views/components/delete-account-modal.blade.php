<div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="deleteAccountModalLabel">
                    <i class="fas fa-user-times text-muted"></i> アカウントの削除について
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
            </div>
            <div class="modal-body text-center py-4">
                <p class="mb-3">アカウントを削除すると以下のデータが削除されます：</p>
                <ul class="list-unstyled text-muted">
                    <li><i class="fas fa-feather me-2"></i>投稿したツイート</li>
                    <li><i class="fas fa-heart me-2"></i>いいねしたツイート</li>
                    <li><i class="fas fa-user me-2"></i>プロフィール情報</li>
                </ul>
                <p class="mt-3 text-muted small">※この操作は取り消すことができません</p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">
                    キャンセル
                </button>
                <form action="{{ route('profile.destroy') }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger rounded-pill">
                        アカウントを削除する
                    </button>
                </form>
            </div>
        </div>
    </div>
</div> 