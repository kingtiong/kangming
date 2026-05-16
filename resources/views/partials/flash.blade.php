@if (session('status'))
    <div class="mb-4 rounded-lg bg-gold-50 border border-gold-200 px-4 py-3 text-gold-800">
        {{ session('status') }}
    </div>
@endif
@if ($errors->any())
    <div class="mb-4 rounded-lg bg-rose-50 border border-rose-200 px-4 py-3 text-rose-800">
        <ul class="list-disc list-inside text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
