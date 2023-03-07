<section>

    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Удалить менюборд') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Как только менюборд будет удален, все его ресурсы и данные будут удалены безвозвратно. Перед удалением менюборда, пожалуйста, загрузите любые данные или информацию, которые вы хотите сохранить.') }}
        </p>
    </header>

    <form action="{{ route('admin.user.menuboard.delete', $menuboard->id) }}" method="POST" class="d-inline-block">
        @csrf
        @method('DELETE')
        <input type="submit" class="btn btn-danger btn-sm" value="Удалить менюборд">
    </form>

</section>
