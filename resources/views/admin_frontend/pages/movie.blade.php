@extends('admin_frontend.components.layout')

@section('title', 'Movies')

@section('content')
    @php
        $movies = App\Models\Movie::latest()->get();
    @endphp

    <div class="mt-6 rounded-[2rem] border border-slate-800/80 bg-slate-950/95 p-4 shadow-[0_30px_80px_rgba(2,6,23,0.28)] sm:p-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm uppercase tracking-[0.3em] text-slate-500">Movie catalog</p>
                <h3 class="mt-2 text-2xl font-semibold text-white">Manage movies</h3>
            </div>
            <a href="#"
                class="inline-flex items-center justify-center rounded-full bg-sky-500 px-5 py-3 text-sm font-semibold text-slate-950 shadow-lg shadow-sky-500/20 transition duration-300 hover:-translate-y-0.5 hover:bg-sky-400">
                Add movie
            </a>
        </div>

        <div class="mt-6 hidden overflow-x-auto md:block">
            <table class="min-w-full border-separate border-spacing-y-2 text-left text-sm text-slate-300">
                <thead class="text-xs uppercase tracking-[0.24em] text-slate-500">
                    <tr>
                        <th class="px-4 py-3">Poster</th>
                        <th class="px-4 py-3">Title</th>
                        <th class="px-4 py-3">Genre</th>
                        <th class="px-4 py-3">Duration</th>
                        <th class="px-4 py-3">Release Date</th>
                        <th class="px-4 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($movies as $movie)
                        @php
                            $posterUrl = null;
                            if (!empty($movie->poster)) {
                                $posterValue = trim($movie->poster);

                                if (\Illuminate\Support\Str::startsWith($posterValue, ['http://', 'https://'])) {
                                    $posterUrl = $posterValue;
                                } elseif (\Illuminate\Support\Facades\Storage::disk('public')->exists($posterValue)) {
                                    $posterUrl = asset('storage/' . $posterValue);
                                } else {
                                    $posterUrl = $posterValue;
                                }
                            }
                        @endphp
                        <tr class="rounded-[1.25rem] bg-slate-900/80 transition duration-300 hover:-translate-y-0.5 hover:bg-slate-800/80">
                            <td class="px-4 py-4">
                                @if ($posterUrl)
                                    <img src="{{ $posterUrl }}" alt="{{ $movie->title }}" class="h-16 w-12 rounded-xl object-cover ring-1 ring-slate-700 transition duration-300 hover:scale-[1.02]" />
                                @else
                                    <div class="flex h-16 w-12 items-center justify-center rounded-xl border border-slate-700 bg-slate-800/80 text-xs text-slate-400">No img</div>
                                @endif
                            </td>
                            <td class="px-4 py-4 font-medium text-white">{{ $movie->title }}</td>
                            <td class="px-4 py-4">{{ $movie->genre ?? 'N/A' }}</td>
                            <td class="px-4 py-4">{{ $movie->duration ? $movie->duration . ' min' : 'N/A' }}</td>
                            <td class="px-4 py-4">{{ $movie->release_date ?
                                \Illuminate\Support\Facades\Date::parse($movie->release_date)->format('M d, Y') : 'N/A' }}</td>
                            <td class="px-4 py-4">
                                <div class="flex flex-wrap gap-2">
                                    <a href="#" class="action-btn rounded-full border border-sky-500/30 px-3 py-1 text-sky-300 hover:bg-sky-500/10">View</a>

                                    <button type="button"
                                        class="js-edit-movie action-btn rounded-full border border-slate-700 px-3 py-1 text-slate-200 hover:bg-slate-800"
                                        data-id="{{ $movie->id }}"
                                        data-title="{{ $movie->title }}"
                                        data-genre="{{ $movie->genre }}"
                                        data-duration="{{ $movie->duration }}"
                                        data-release_date="{{ $movie->release_date ? \Illuminate\Support\Facades\Date::parse($movie->release_date)->format('Y-m-d') : '' }}"
                                        data-poster="{{ $posterUrl }}"
                                        data-update-url="{{ route('admin.movies.update', $movie) }}">
                                        Edit
                                    </button>

                                    <button type="button"
                                        class="js-delete-movie action-btn rounded-full border border-rose-500/30 px-3 py-1 text-rose-300 hover:bg-rose-500/10"
                                        data-title="{{ $movie->title }}"
                                        data-delete-url="{{ route('admin.movies.destroy', $movie) }}">
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="rounded-[1.25rem] bg-slate-900/80">
                            <td colspan="6" class="px-4 py-6 text-center text-slate-400">No movies found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6 space-y-3 md:hidden">
            @forelse ($movies as $movie)
                @php
                    $posterUrl = null;
                    if (!empty($movie->poster)) {
                        $posterValue = trim($movie->poster);

                        if (\Illuminate\Support\Str::startsWith($posterValue, ['http://', 'https://'])) {
                            $posterUrl = $posterValue;
                        } elseif (\Illuminate\Support\Facades\Storage::disk('public')->exists($posterValue)) {
                            $posterUrl = asset('storage/' . $posterValue);
                        } else {
                            $posterUrl = $posterValue;
                        }
                    }
                @endphp

                <div class="soft-card rounded-[1.5rem] border border-slate-800/80 bg-slate-900/80 p-4 shadow-lg shadow-slate-950/20">
                    <div class="flex items-start gap-3">
                        @if ($posterUrl)
                            <img src="{{ $posterUrl }}" alt="{{ $movie->title }}" class="h-20 w-14 rounded-xl object-cover ring-1 ring-slate-700" />
                        @else
                            <div class="flex h-20 w-14 items-center justify-center rounded-xl border border-slate-700 bg-slate-800/80 text-xs text-slate-400">No img</div>
                        @endif

                        <div class="min-w-0 flex-1">
                            <div class="flex items-start justify-between gap-2">
                                <h4 class="truncate font-semibold text-white">{{ $movie->title }}</h4>
                                <span class="rounded-full border border-sky-500/20 bg-sky-500/10 px-2.5 py-1 text-[11px] uppercase tracking-[0.22em] text-sky-300">{{ $movie->genre ?? 'N/A' }}</span>
                            </div>
                            <p class="mt-2 text-sm text-slate-400">{{ $movie->duration ? $movie->duration . ' min' : 'N/A' }}</p>
                            <p class="mt-1 text-sm text-slate-400">{{ $movie->release_date ? \Illuminate\Support\Facades\Date::parse($movie->release_date)->format('M d, Y') : 'N/A' }}</p>
                        </div>
                    </div>

                    <div class="mt-4 flex flex-wrap gap-2">
                        <a href="#" class="action-btn rounded-full border border-sky-500/30 px-3 py-1.5 text-sm text-sky-300 hover:bg-sky-500/10">View</a>

                        <button type="button"
                            class="js-edit-movie action-btn rounded-full border border-slate-700 px-3 py-1.5 text-sm text-slate-200 hover:bg-slate-800"
                            data-id="{{ $movie->id }}"
                            data-title="{{ $movie->title }}"
                            data-genre="{{ $movie->genre }}"
                            data-duration="{{ $movie->duration }}"
                            data-release_date="{{ $movie->release_date ? \Illuminate\Support\Facades\Date::parse($movie->release_date)->format('Y-m-d') : '' }}"
                            data-poster="{{ $posterUrl }}"
                            data-update-url="{{ route('admin.movies.update', $movie) }}">
                            Edit
                        </button>

                        <button type="button"
                            class="js-delete-movie action-btn rounded-full border border-rose-500/30 px-3 py-1.5 text-sm text-rose-300 hover:bg-rose-500/10"
                            data-title="{{ $movie->title }}"
                            data-delete-url="{{ route('admin.movies.destroy', $movie) }}">
                            Delete
                        </button>
                    </div>
                </div>
            @empty
                <div class="rounded-[1.5rem] border border-slate-800/80 bg-slate-900/80 p-6 text-center text-slate-400">No movies found.</div>
            @endforelse
        </div>
    </div>

    {{-- ===================== EDIT MODAL ===================== --}}
    <div id="edit-movie-modal" class="fixed inset-0 z-50 hidden items-center justify-center px-4">
        <div id="edit-movie-backdrop" class="absolute inset-0 bg-slate-950/70 opacity-0 transition-opacity duration-300"></div>

        <div id="edit-movie-panel"
            class="relative w-full max-w-lg translate-y-4 scale-95 rounded-[2rem] border border-slate-800 bg-slate-950 p-6 opacity-0 shadow-2xl shadow-slate-950/40 transition-all duration-300 max-h-[90vh] overflow-y-auto">

            <div class="flex items-center justify-between gap-3">
                <div>
                    <p class="text-xs uppercase tracking-[0.3em] text-slate-500">Movie catalog</p>
                    <h3 class="mt-1 text-xl font-semibold text-white">Edit movie</h3>
                </div>
                <button type="button" id="edit-movie-close" class="rounded-full border border-slate-700 p-2 text-slate-300 transition hover:bg-slate-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>

            <form id="edit-movie-form" method="POST" enctype="multipart/form-data" class="mt-6 space-y-4">
                @csrf
                @method('PUT')

                {{-- Poster --}}
                <div>
                    <p class="mb-2 text-sm text-slate-400">Poster</p>
                    <div class="flex items-center gap-4">
                        <img id="edit_poster_preview" src="" alt="Poster preview"
                            class="h-24 w-16 rounded-xl border border-slate-700 object-cover bg-slate-900">

                        <div class="flex flex-col gap-2">
                            <label for="edit_poster" class="inline-flex cursor-pointer items-center gap-2 rounded-full bg-sky-500 px-4 py-2.5 text-sm font-semibold text-slate-950 transition hover:bg-sky-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 14.899A7 7 0 1 1 15.71 8h1.79a4.5 4.5 0 0 1 2.5 8.242"></path>
                                    <path d="M12 12v9"></path>
                                    <path d="m16 16-4-4-4 4"></path>
                                </svg>
                                Change poster
                            </label>
                            <input type="file" id="edit_poster" name="poster" accept="image/png, image/jpeg, image/webp" class="hidden">
                            <p class="text-xs text-slate-500">PNG, JPG or WEBP under 5MB</p>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="mb-2 block text-sm text-slate-400" for="edit_title">Title</label>
                    <input id="edit_title" name="title" type="text" class="w-full rounded-2xl border border-slate-700 bg-slate-900 px-4 py-3 text-white focus:border-sky-500 focus:outline-none" required>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label class="mb-2 block text-sm text-slate-400" for="edit_genre">Genre</label>
                        <input id="edit_genre" name="genre" type="text" class="w-full rounded-2xl border border-slate-700 bg-slate-900 px-4 py-3 text-white focus:border-sky-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="mb-2 block text-sm text-slate-400" for="edit_duration">Duration (min)</label>
                        <input id="edit_duration" name="duration" type="number" min="1" class="w-full rounded-2xl border border-slate-700 bg-slate-900 px-4 py-3 text-white focus:border-sky-500 focus:outline-none">
                    </div>
                </div>

                <div>
                    <label class="mb-2 block text-sm text-slate-400" for="edit_release_date">Release date</label>
                    <input id="edit_release_date" name="release_date" type="date" class="w-full rounded-2xl border border-slate-700 bg-slate-900 px-4 py-3 text-white focus:border-sky-500 focus:outline-none">
                </div>

                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" id="edit-movie-cancel" class="rounded-full border border-slate-700 px-5 py-3 text-sm text-slate-200 transition hover:bg-slate-900">Cancel</button>
                    <button type="submit" class="rounded-full bg-sky-500 px-6 py-3 text-sm font-semibold text-slate-950 transition hover:bg-sky-400">Save changes</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ===================== DELETE CONFIRM MODAL ===================== --}}
    <div id="delete-movie-modal" class="fixed inset-0 z-50 hidden items-center justify-center px-4">
        <div id="delete-movie-backdrop" class="absolute inset-0 bg-slate-950/70 opacity-0 transition-opacity duration-300"></div>

        <div id="delete-movie-panel"
            class="relative w-full max-w-sm translate-y-4 scale-95 rounded-[2rem] border border-slate-800 bg-slate-950 p-6 opacity-0 shadow-2xl shadow-slate-950/40 transition-all duration-300">

            <div class="flex h-12 w-12 items-center justify-center rounded-full border border-rose-500/30 bg-rose-500/10 text-rose-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                    <line x1="12" y1="9" x2="12" y2="13"></line>
                    <line x1="12" y1="17" x2="12.01" y2="17"></line>
                </svg>
            </div>

            <h3 class="mt-4 text-lg font-semibold text-white">Delete movie</h3>
            <p class="mt-2 text-sm text-slate-400">
                Do you want to delete <span id="delete-movie-title" class="font-medium text-slate-200"></span>? This action cannot be undone.
            </p>

            <form id="delete-movie-form" method="POST" class="mt-6 flex justify-end gap-3">
                @csrf
                @method('DELETE')
                <button type="button" id="delete-movie-cancel" class="rounded-full border border-slate-700 px-5 py-3 text-sm text-slate-200 transition hover:bg-slate-900">Cancel</button>
                <button type="submit" class="rounded-full bg-rose-500 px-6 py-3 text-sm font-semibold text-white transition hover:bg-rose-400">Yes, delete</button>
            </form>
        </div>
    </div>

    <script>
        (function () {
            function openModal(modal, backdrop, panel) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                requestAnimationFrame(function () {
                    backdrop.classList.remove('opacity-0');
                    panel.classList.remove('opacity-0', 'scale-95', 'translate-y-4');
                });
            }

            function closeModal(modal, backdrop, panel) {
                backdrop.classList.add('opacity-0');
                panel.classList.add('opacity-0', 'scale-95', 'translate-y-4');
                setTimeout(function () {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                }, 300);
            }

            // ---------- EDIT MODAL ----------
            var editModal = document.getElementById('edit-movie-modal');
            var editBackdrop = document.getElementById('edit-movie-backdrop');
            var editPanel = document.getElementById('edit-movie-panel');
            var editForm = document.getElementById('edit-movie-form');
            var editPosterInput = document.getElementById('edit_poster');
            var editPosterPreview = document.getElementById('edit_poster_preview');

            document.querySelectorAll('.js-edit-movie').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    editForm.action = btn.dataset.updateUrl;
                    document.getElementById('edit_title').value = btn.dataset.title || '';
                    document.getElementById('edit_genre').value = btn.dataset.genre || '';
                    document.getElementById('edit_duration').value = btn.dataset.duration || '';
                    document.getElementById('edit_release_date').value = btn.dataset.release_date || '';

                    editPosterInput.value = '';
                    editPosterPreview.src = btn.dataset.poster || '';
                    editPosterPreview.style.visibility = btn.dataset.poster ? 'visible' : 'hidden';

                    openModal(editModal, editBackdrop, editPanel);
                });
            });

            editPosterInput.addEventListener('change', function (e) {
                var file = e.target.files[0];
                if (!file) return;

                var reader = new FileReader();
                reader.onload = function (event) {
                    editPosterPreview.src = event.target.result;
                    editPosterPreview.style.visibility = 'visible';
                };
                reader.readAsDataURL(file);
            });

            document.getElementById('edit-movie-close').addEventListener('click', function () {
                closeModal(editModal, editBackdrop, editPanel);
            });
            document.getElementById('edit-movie-cancel').addEventListener('click', function () {
                closeModal(editModal, editBackdrop, editPanel);
            });
            editBackdrop.addEventListener('click', function () {
                closeModal(editModal, editBackdrop, editPanel);
            });

            // ---------- DELETE MODAL ----------
            var deleteModal = document.getElementById('delete-movie-modal');
            var deleteBackdrop = document.getElementById('delete-movie-backdrop');
            var deletePanel = document.getElementById('delete-movie-panel');
            var deleteForm = document.getElementById('delete-movie-form');
            var deleteTitleEl = document.getElementById('delete-movie-title');

            document.querySelectorAll('.js-delete-movie').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    deleteForm.action = btn.dataset.deleteUrl;
                    deleteTitleEl.textContent = '"' + (btn.dataset.title || 'this movie') + '"';

                    openModal(deleteModal, deleteBackdrop, deletePanel);
                });
            });

            document.getElementById('delete-movie-cancel').addEventListener('click', function () {
                closeModal(deleteModal, deleteBackdrop, deletePanel);
            });
            deleteBackdrop.addEventListener('click', function () {
                closeModal(deleteModal, deleteBackdrop, deletePanel);
            });

            // ---------- ESC key closes whichever is open ----------
            document.addEventListener('keydown', function (e) {
                if (e.key !== 'Escape') return;
                if (!editModal.classList.contains('hidden')) closeModal(editModal, editBackdrop, editPanel);
                if (!deleteModal.classList.contains('hidden')) closeModal(deleteModal, deleteBackdrop, deletePanel);
            });
        })();
    </script>
@endsection
