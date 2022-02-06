<x-app-layout>
    <section class="body-font">
        <div class="w-full bg-gray-100 flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div class="flex flex-wrap w-full sm:max-w-md mx-auto pt-48">
                <div class="lg:w-1/2 w-full mb-6 ">
                    <h1 class="sm:text-3xl text-2xl font-medium title-font mb-2 text-gray-900">要約の登録</h1>
                    <div class="h-1 w-36 bg-blue-500 rounded"></div>
                </div>
            </div>
            <div class="w-full sm:max-w-md mx-auto bg-white rounded-3xl border shadow-lg p-6">
                <form action="{{ route('summary.store') }}" method="POST">
                @csrf
                <x-auth-validation-errors :errors="$errors" />
                <div class="mb-4">
                    <textarea name="content" cols="30" rows="10" class="appearance-none rounded-none px-3 py-2 border border-gray-300 text-gray-900 rounded-t-md rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm w-full">{{old('content')}}</textarea>
                    <input type="hidden" name="book_id" value="{{$id}}">
                    <input type="button" onclick="location.href='{{route('show', ['id' => $id])}}' " value="戻る" class="text-gray-500 font-semibold py-2 px-4 mx-4 ">
                    <input type="submit" value="登録" class="ml-2 px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold capitalize text-white hover:bg-blue-700 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 disabled:opacity-25 transition">
                </form>
                </div>
            </div>
        </div>
    </section>

</x-app-layout>
