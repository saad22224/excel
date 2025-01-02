<div>

    <input wire:model="search" class="form-control mt-2" type="text" placeholder="Search users..."/>

    @if($users->count() > 0)
        <div class="card mt-4" wire:poll.keep-alive>
            <div class="card-header bg-secondary text-white">
                <h4 class="mb-0">Imported Users</h4>
            </div>
            <div class="card-body p-0">
                <table class="table table-bordered mb-0" style="background-color: #f9f9f9;">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $index => $user)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-3">
            {{ $users->links() }}
        </div>
    @else
    @if($search)
            <div class="alert alert-warning mt-4">
                No users match your search.
            </div>
        @else
            <div class="alert alert-info mt-4">
                No users imported yet.
            </div>
        @endif
    @endif
</div>
