<x-app-layout>
    <div
    class="relative pt-16 pb-32 flex content-center items-center justify-center"
    style="min-height: 75vh;"
    >
    <div
        class="absolute top-0 w-full h-full bg-center bg-cover"
        style='background-image: url("{{asset('images/dashboard_image.jpg')}}")'
    >
    <span class="w-full h-full absolute opacity-50 bg-gray-900"></span>
    </div>
    <div class="container relative mx-auto">
        <div class="items-center flex flex-wrap">
        <div class="w-full lg:w-6/12 px-4 ml-auto mr-auto text-center">
            <div class="pr-12">
            <div class="shrink-0 flex items-center">
                <x-application-logo class="block w-auto fill-current" />
                <h1 class="text-white font-semibold text-5xl ml-4">
                    BookOutput
                </h1>
            </div>
            <p class="mt-4 text-lg text-gray-200">
                本を読んだだけでは終わらせない読書体験がここに。要約とクイズ作成によって、本で得た知識や知見を定着させましょう。
            </p>
            </div>
        </div>
        </div>
    </div>
    </div>
<!-- component -->
<div class="flex flex-wrap items-center  justify-center mt-8 pb-20">
    <div class="container pb-12 lg:w-2/6 xl:w-2/7 sm:w-full md:w-2/3 bg-white shadow-lg transform duration-200 easy-in-out">
        <div class=" h-20 bg-white" >
            <p class="text-center font-semibold text-3xl text-sky-500 mt-6">~Profile~</p>
        </div>
        <div class="flex justify-center px-5  -mt-12">
            <img class="object-cover my-4 w-32 h-32 mx-autobg-white p-2 rounded-full" src="{{asset('images/profile.jpg')}}" alt="" />
        </div>
            <div class="text-center px-14">
                <h2 class="text-gray-800 text-3xl font-medium">大隈滉士</h2>
                <p class="text-gray-400">Koshi Okuma</p>
                <p class="mt-2 text-gray-600 leading-7">
                    2000年生まれ福岡県出身。<br>年に150冊の本を読む読書家。<br>大学在学中にプログラミングと出会い、読書に関する課題解決のために当サービスを開発。
                </p>
            </div>
    </div>
</div>

<section class="text-gray-600 body-font">
    <div class="container px-5 py-12 mx-auto">
      <div class="flex items-center lg:w-3/5 mx-auto border-b pb-10 mb-10 border-gray-200 sm:flex-row flex-col">
        <div class="sm:w-32 sm:h-32 h-20 w-20 sm:mr-10 inline-flex items-center justify-center rounded-full bg-blue-100 text-blue-500 flex-shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="sm:w-16 sm:h-16 w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg>
        </div>
        <div class="flex-grow sm:text-left text-center mt-6 sm:mt-0">
          <h2 class="text-gray-900 text-lg title-font font-medium mb-2">本の登録</h2>
          <p class="leading-7 text-base">まずは読み終わった本、もしくは今読んでいる本を登録します。次にその本の要約や内容に関するクイズを作成することができます。</p>
          <a href="{{route('create')}}" class="mt-3 text-blue-500 inline-flex items-center">Let's Do It
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
              <path d="M5 12h14M12 5l7 7-7 7"></path>
            </svg>
          </a>
        </div>
      </div>
      <div class="flex items-center lg:w-3/5 mx-auto border-b pb-10 mb-10 border-gray-200 sm:flex-row flex-col">
        <div class="flex-grow sm:text-left text-center mt-6 sm:mt-0">
          <h2 class="text-gray-900 text-lg title-font font-medium mb-2">みんなの投稿</h2>
          <p class="leading-7 text-base">他のユーザーが登録した要約の閲覧やクイズの解答ができます。気になった本はその場で購入しちゃいましょう！</p>
          <a href="{{route('index')}}" class="mt-3 text-blue-500 inline-flex items-center">Go HOME
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
              <path d="M5 12h14M12 5l7 7-7 7"></path>
            </svg>
          </a>
        </div>
        <div class="sm:w-32 sm:order-none order-first sm:h-32 h-20 w-20 sm:ml-10 inline-flex items-center justify-center rounded-full bg-blue-100 text-blue-500 flex-shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="sm:w-16 sm:h-16 w-10 h-10" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10.496 2.132a1 1 0 00-.992 0l-7 4A1 1 0 003 8v7a1 1 0 100 2h14a1 1 0 100-2V8a1 1 0 00.496-1.868l-7-4zM6 9a1 1 0 00-1 1v3a1 1 0 102 0v-3a1 1 0 00-1-1zm3 1a1 1 0 012 0v3a1 1 0 11-2 0v-3zm5-1a1 1 0 00-1 1v3a1 1 0 102 0v-3a1 1 0 00-1-1z" clip-rule="evenodd" />
              </svg>
        </div>
      </div>
      <div class="flex items-center lg:w-3/5 mx-auto sm:flex-row flex-col">
        <div class="sm:w-32 sm:h-32 h-20 w-20 sm:mr-10 inline-flex items-center justify-center rounded-full bg-blue-100 text-blue-500 flex-shrink-0">
          <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="sm:w-16 sm:h-16 w-10 h-10" viewBox="0 0 24 24">
            <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"></path>
            <circle cx="12" cy="7" r="4"></circle>
          </svg>
        </div>
        <div class="flex-grow sm:text-left text-center mt-6 sm:mt-0">
          <h2 class="text-gray-900 text-lg title-font font-medium mb-2">マイページ</h2>
          <p class="leading-7 text-base">マイページではあなたが登録した本の一覧を見ることができます。また、本を非公開にした状態での要約やクイズの作成もできます。</p>
          <a href="{{route('mypage.index')}}" class="mt-3 text-blue-500 inline-flex items-center">Go to Mypage
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
              <path d="M5 12h14M12 5l7 7-7 7"></path>
            </svg>
          </a>
        </div>
      </div>
    </div>
  </section>

  <footer class="text-gray-600 body-font">
    <div class="container px-5 py-8 pb-8 mx-auto flex items-center sm:flex-row flex-col">
      <a class="flex title-font font-medium items-center md:justify-start justify-center text-gray-900">
        <a href="{{ route('index') }}">
            <x-application-logo class="block h-10 w-auto fill-current" />
        </a>
        <a href="{{route('index')}}"><span class="text-black ml-3 text-xl">BookOutput</span></a>
      </a>
      <p class="text-sm text-gray-500 sm:ml-4 sm:pl-4 sm:border-l-2 sm:border-gray-200 sm:py-2 sm:mt-0 mt-4">大隈滉士 — koshi.okuma@gmail.com</p>
    </div>
  </footer>

</x-app-layout>
