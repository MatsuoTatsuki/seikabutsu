<x-app-layout>
    <div class="container mx-auto p-4 flex">
        <div class="container mx-auto max-w-3xl p-6 bg-white shadow-lg rounded-lg mt-16 ">
            <h1 class="text-2xl font-semibold mb-6 text-center">コミュニティの作成</h1>
            <form action="{{ route('communities.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-6">
                    <label for="name" class="block text-lg font-medium text-gray-700 mb-2">コミュニティ名</label>
                    <input type="text" name="name" id="name" class="w-full border border-gray-300 rounded-lg p-3 focus:ring focus:ring-blue-500 focus:border-blue-500" placeholder="コミュニティ名を入力" required>
                </div>

                <div class="mb-6">
                    <label for="description" class="block text-lg font-medium text-gray-700 mb-2">コミュニティの説明</label>
                    <textarea name="description" id="description" rows="4" class="w-full border border-gray-300 rounded-lg p-3 focus:ring focus:ring-blue-500 focus:border-blue-500" placeholder="コミュニティの説明を入力"></textarea>
                </div>

                <div class="mb-6">
                    <label for="icon" class="block text-lg font-medium text-gray-700 mb-2">コミュニティのアイコン</label>
                    <input type="file" name="icon" id="icon" class="w-full text-gray-700 p-3 border border-gray-300 rounded-lg">
                </div>

                <div class="flex justify-center">
                    <button type="submit" class="bg-gray-500 text-white px-6 py-3 rounded-lg hover:bg-gray-600">
                        作成
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
