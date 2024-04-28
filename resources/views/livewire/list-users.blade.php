<div>
    <div class="text-gray-900 bg-gray-200 h-screen">
        <div class="p-4 mb-4 flex justify-between items-end">
            <h1 class="text-3xl">
                Users
            </h1>
            <livewire:create-user />
        </div>
        <div class="px-3 pb-4 flex justify-center">
            <table class="w-full text-md bg-white shadow-md rounded mb-4">
                <tbody>
                <tr class="border-b">
                    <th class="text-left p-3 px-5">Name</th>
                    <th class="text-left p-3 px-5">Email</th>
                    <th></th>
                </tr>
                @foreach($users as $user)
                <tr wire:key="{{$user->getKey()}}" class="border-b hover:bg-gray-300 bg-gray-100">
                    <td class="p-3 px-5">{{ $user->name }}</td>
                    <td class="p-3 px-5">{{ $user->email }}</td>
                    <td class="p-3 px-5 flex justify-end">
                        <span class="mr-3">
                            <livewire:edit-user :$user :key="$user->getKey()" />
                        </span>
                        <x-delete-button
                            :user="$user"
                        />
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-4">{{ $users->links() }}</div>
    </div>
    <x-notifications />
</div>
