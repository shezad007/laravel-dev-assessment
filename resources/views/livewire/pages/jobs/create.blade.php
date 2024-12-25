<div>
    <div class="container mx-auto py-4">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold">Create new job posting</h1>
        </div>
        
        <form wire:submit.prevent="submit" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Job Details Card -->
            <div class="card p-4 bg-white shadow-md rounded-lg md:col-span-2">
                <h2 class="text-xl font-medium mb-4">Job Details</h2>
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium">Title</label>
                    <input type="text" id="title" wire:model="title" class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
                    @error('title') <span class="error text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium">Description</label>
                    <textarea id="description" wire:model="description" class="w-full mt-1 border-gray-300 rounded-md shadow-sm"></textarea>
                    @error('description') <span class="error text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="experience" class="block text-sm font-medium">Experience</label>
                        <input type="text" id="experience" wire:model="experience" placeholder="Eg. 1-3 Yrs" class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
                        @error('experience') <span class="error text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="salary" class="block text-sm font-medium">Salary</label>
                        <input type="text" id="salary" wire:model="salary" placeholder="Eg. 2.75-5 Lacs PA" class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
                        @error('salary') <span class="error text-red-500">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="location" class="block text-sm font-medium">Location</label>
                        <input type="text" id="location" wire:model="location" placeholder="Eg. Remote / Pune" class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
                        @error('location') <span class="error text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="extra" class="block text-sm font-medium">Extra Info</label>
                        <input type="text" id="extra" wire:model="extra" placeholder="Eg. Full Time, Urgent" class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
                        @error('extra') <span class="error text-red-500">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <!-- Company Details Card -->
            <div class="card p-4 bg-white shadow-md rounded-lg md:col-span-1">
                <h2 class="text-xl font-medium mb-4">Company Details</h2>
                <div class="mb-4">
                    <label for="company_name" class="block text-sm font-medium">Company Name</label>
                    <input type="text" id="company_name" wire:model="company_name" class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
                    @error('company_name') <span class="error text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="logo" class="block text-sm font-medium">Logo</label>
                    <input type="file" id="logo" wire:model="logo" class="w-full mt-1">
                </div>
                <h2 class="text-xl font-medium mb-4">Skills</h2>
                <div class="mb-4">
                    <label for="skills" class="block text-sm font-medium">Select Skills</label>
                    <select multiple id="skills" wire:model="skills" class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
                        @foreach ($default_skills as $skill)
                        <option value="{{ $skill->name }}">{{ $skill->name }}</option>
                        @endforeach
                    </select>
                    @error('skills') <span class="error text-red-500">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Save Button -->
            <div class="col-span-2 flex justify-start">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-medium rounded-lg shadow-md hover:bg-blue-700">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>
