<x-app-layout>
    <section class="body-font">
        <div class="w-full  bg-gray-100 flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div class="flex flex-wrap w-full sm:max-w-md mx-auto pt-48">
                <div class="lg:w-1/2 w-full mb-6 ">
                    <h1 class="sm:text-3xl text-2xl font-medium title-font mb-2 text-gray-900">問題の編集</h1>
                    <div class="h-1 w-28 bg-blue-500 rounded"></div>
                </div>
            </div>
            <div class="w-full sm:max-w-md mx-auto bg-white rounded-3xl border shadow-lg p-6">
                <form action="{{ route('question.update') }}" method="POST">
                @csrf
                <x-auth-validation-errors :errors="$errors" />
                <div class="mb-4">
                    <label class="block mb-1" for="question">問題文</label>
                    <input id="question" type="text" name="question" value="{{$question->content}}" class="appearance-none rounded-none px-3 py-2 border border-gray-300 text-gray-900 rounded-t-md rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm w-full" />
                </div>
                <div class="mb-4">
                    <label class="block mb-1" for="answer">答え</label>
                    <input id="answer" type="text" name="answer" value="{{$question->choice[0]->content}}" class="appearance-none rounded-none px-3 py-2 border border-gray-300 text-gray-900 rounded-t-md rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm w-full" />
                </div>
                <div class="mb-4">
                    <label class="block mb-1" for="wrong_answer1">誤答1</label>
                    <input id="wrong_answer1" type="text" name="wrong_answer1" value="{{$question->choice[1]->content}}" class="appearance-none rounded-none px-3 py-2 border border-gray-300 text-gray-900 rounded-t-md rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm w-full" />
                </div>
                <div class="mb-4">
                    <label class="block mb-1" for="wrong_answer2">誤答2</label>
                    <input id="wrong_answer2" type="text" name="wrong_answer2" value="{{$question->choice[2]->content}}" class="appearance-none rounded-none px-3 py-2 border border-gray-300 text-gray-900 rounded-t-md rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm w-full" />
                </div>
                <div class="mb-4">
                    <label class="block mb-1" for="description">解説</label>
                    <input id="description" type="text" name="description" value="{{$question->description}}" class="appearance-none rounded-none px-3 py-2 border border-gray-300 text-gray-900 rounded-t-md rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm w-full" />
                </div>
                    <input type="hidden" name="book_id" value="{{$question->book_id}}">
                    <input type="hidden" name="question_id" value="{{$question->id}}">
                    <input type="hidden" name="choices[0]" value="{{$question->choice[0]->id}}">
                    <input type="hidden" name="choices[1]" value="{{$question->choice[1]->id}}">
                    <input type="hidden" name="choices[2]" value="{{$question->choice[2]->id}}">
                    <input type="button" onclick="location.href='{{route('show', ['id' => $question->book_id])}}' " value="戻る" class="text-gray-500 font-semibold py-2 px-8 ">
                    <input type="submit" value="更新" class="ml-2 px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold capitalize text-white hover:bg-blue-700 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 disabled:opacity-25 transition">
                </form>
        </div>
    </div>
    </section>

<script>
    function deleteBook(e) {
        'use strict'
        if(confirm('本当に削除しますか？')){
            document.getElementById('delete_' + e.dataset.id).submit();
        }
    }
</script>

</x-app-layout>
