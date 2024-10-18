<x-app-layout>
    <head>
        <!-- Alpine.jsを追加 -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </head>

    <div class="container mx-auto flex flex-col items-center justify-center min-h-screen">
        <!-- 検索フォームと投稿一覧ボタン -->
        <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-8 mb-8">
            <form action="/posts/search" method="POST" class="flex space-x-4 items-center">
                @csrf
                <input type="text" name="query" placeholder="場所を入力してください" 
                    class="p-2 border border-gray-300 rounded w-full" />
                <button type="submit" 
                    class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600">
                    検索
                </button>
            </form>

            <!-- 投稿一覧へボタン -->
            <div class="mt-6">
                <a href="/posts/index" 
                    class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600 transition duration-300 w-full block text-center">
                    投稿一覧へ
                </a>
            </div>

            <!-- 使い方ガイドリンク -->
            <div class="mt-4 text-center" x-data="{ open: false }">
                <button @click="open = true" 
                    class="text-gray-500 underline hover:text-gray-700">
                    使い方ガイド
                </button>

                <!-- ポップアップ -->
                <div x-show="open" @click.away="open = false" 
                    class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
                    <div class="bg-white p-6 rounded-lg shadow-lg max-w-lg">
                        <h2 class="text-xl font-semibold mb-4">使い方ガイド</h2>
                        <p>使い方はシンプルです！</p>
                        <p>購入した古着を投稿してください！</p>
                        <div class="mt-6 text-center">
                            <button @click="open = false" 
                                class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600">
                                閉じる
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
