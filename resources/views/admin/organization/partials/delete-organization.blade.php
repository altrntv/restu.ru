<section>

    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Удалить организацию') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Как только организация будет удалена, все ее ресурсы и данные будут удалены безвозвратно. Перед удалением организации, пожалуйста, загрузите любые данные или информацию, которые вы хотите сохранить.') }}
        </p>
    </header>

    <form action="{{ route('admin.organization.delete', $organization->id) }}" method="POST" class="d-inline-block">
        @csrf
        @method('DELETE')
        <input type="submit" class="btn btn-danger btn-sm" value="Удалить организацию">
    </form>

</section>
