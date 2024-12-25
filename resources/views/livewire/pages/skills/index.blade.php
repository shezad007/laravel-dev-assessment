<div>
    <div class="container mx-auto py-4">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold">Skills</h1>
        </div>
        @if (session()->has('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        <div class="flex gap-6">
            <div class="w-2/3 bg-white rounded shadow">
                <table class="w-full table-auto border-collapse">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="text-left py-2 px-4">Name</th>
                            <th class="text-right py-2 px-4"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($skills as $skill)
                        <tr class="border-t">
                            <td class="py-2 px-4">{{ $skill->name }}</td>
                            <td class="text-right py-2 px-4">
                                <button class="text-blue-600 hover:underline">Edit</button>
                                <button class="text-red-600 hover:underline">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="w-1/3 bg-white rounded shadow p-4">
                <h2 class="text-xl font-bold mb-4">Add New Skill</h2>
                <form wire:submit.prevent="store">
                    <label for="skill-name" class="block text-sm font-medium mb-2">Name</label>
                    <input
                        type="text"
                        id="skill_name"
                        wire:model="skill_name"
                        placeholder="Skill name"
                        class="w-full border rounded px-3 py-2 mb-4"
                    />
                    <button
                        type="submit"
                        class="w-full bg-blue-600 text-white rounded px-4 py-2 hover:bg-blue-700"
                    >
                        Save
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
