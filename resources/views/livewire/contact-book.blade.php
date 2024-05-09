<div class="container">
    <div class="d-flex align-items-center justify-content-center" style="height: 70vh;">
        <div class="card p-5 " style="width: 600px; ">
            <div class="card-body">
                <h3 class="card-title">Contact Info</h3>
                <form wire:submit.prevent="Add">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" id="name" class="form-control" wire:model="name">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="phone" id="phone" class="form-control" wire:model="phone">
                        @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Add Contact</button>
                </form>

            </div>
            <table>
                <h3>Contact Book</h3>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contacts as $contact)
                    <tr>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->phone }}</td>
                        <td>
                            <button wire:click="editModal(true, {{$contact->id}})">Edit</button>
                            <button wire:click="deleteContact({{ $contact->id }})">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{-- Edit-modal --}}
    <div class="modal   {{$show_edit_modal ? 'd-block' : '' }}" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Contact</h1>
                    <button type="button" class="btn-close" wire:click="cancelEdit(false)" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <h3 class="card-title">Contact Info</h3>
                        <form>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" id="name" class="form-control" wire:model="name">
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="phone" id="phone" class="form-control" wire:model="phone">
                                @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </form>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="cancelEdit(false)">Close</button>
                    <button type="button" class="btn btn-primary" wire:click="update">update</button>
                </div>
            </div>
        </div>
    </div>
</div>