<x-base>
  <main class="bg-sky-100/20 w-screen h-screen overflow-hidden">
    <div class="isolate relative flex flex-col justify-center items-center px-6 lg:px-8 h-full">
      <!-- Background gradient -->
      <div class="-top-40 sm:-top-80 -z-10 absolute inset-x-0 blur-3xl overflow-hidden transform-gpu pointer-events-none" aria-hidden="true">
        <div
            class="left-[calc(50%-11rem)] sm:left-[calc(50%-30rem)] relative bg-gradient-to-tr from-[#7fbdea] to-[#9980fc] opacity-20 w-[36.125rem] sm:w-[72.1875rem] aspect-[1155/678] rotate-[30deg] -translate-x-1/2"
            style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"
        ></div>
      </div>
      <!-- Bottom gradient -->
      <div class="top-[calc(100%-13rem)] sm:top-[calc(100%-30rem)] -z-10 absolute inset-x-0 blur-3xl overflow-hidden transform-gpu pointer-events-none" aria-hidden="true">
        <div class="left-[calc(50%+3rem)] sm:left-[calc(50%+36rem)] relative bg-gradient-to-tr from-[#7fbdea] to-[#9980fc] opacity-20 w-[36.125rem] sm:w-[72.1875rem] aspect-[1155/678] -translate-x-1/2" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
      </div>
      <!-- Hero section -->
      <div class="mx-auto py-32 sm:py-48 lg:py-56 max-w-2xl">
        <div class="text-center">
          <!-- Text -->
          <h1 class="font-semibold text-gray-800 text-5xl sm:text-7xl text-balance tracking-tight">Tempest</h1>
          <p class="mt-8 font-medium text-gray-500 text-lg sm:text-xl/8 text-pretty">The PHP framework that gets out of your way.</p>
          <!-- CTAs -->
          <div class="flex sm:flex-row flex-col justify-center items-center gap-x-6 gap-y-4 mt-10">
            <a href="https://tempestphp.com/docs" target="_blank" class="bg-sky-600 hover:bg-sky-500 shadow-sm px-3.5 py-2.5 rounded-md focus-visible:outline-2 focus-visible:outline-sky-600 focus-visible:outline-offset-2 font-semibold text-white text-sm">Documentation</a>
            <a href="https://tempestphp.com/discord" class="focus-visible:outline-none font-semibold text-gray-900 text-sm/6 focus-visible:decoration-gray-300 focus-visible:underline focus-visible:underline-offset-4">
              Join our Discord
              <span aria-hidden="true">→</span>
            </a>
          </div>
        </div>
      </div>
        <div id="test" sf-data="{ foo: 'test'}">
            <button class="border px-4 py-8" onclick="console.log(http.get)">asfd</button>
            <input class="border" type="text" onkeyup="Key.Enter() && console.log(this.value)" />
            <br onload="bind('my-signal')"/>
        </div>


        <div x-data="{open: false}">
            <button x-on:click="open = true">show</button>
            <div x-show="open">
                asdfasdf
            </div>
        </div>

        <button command="--show" commandfor="list"> toggle shit</button>
        <ul id="list" oncommand="event.command === '--show' && this.toggleAttribute('data-open')" class="hidden data-[open]:block">
            <li> list 1</li>
        </ul>
<button onclick="firstname.value = 'testing'; firstname.dispatchEvent(new InputEvent('input', {
  bubbles: true,
  cancelable: true,
  inputType: 'insertText',
  data: 'new value'
}))" class="border p-8">Set first name from button</button>
<div  oninput="foobar.value = firstname.value * lastname.value">
    test: <output id="foobar" for="firstname lastname"></output>
        <form id="asdfasdf" onsubmit="post('/test')" oninput="fullname.value = firstname.value * lastname.value" class="space-y-8">
            <x-csrf-token />
            <label for="firstname" class="invalid:text-red-500">First Name</label>
            <input id="firstname" name="first" type="text" class="border invalid:border-amber-700"/>
            <input id="lastname" name="last" type="text" class="border invalid:bg-amber-700" minlength="10"/>
            <output id="fullname" for="firstname lastname"></output>
            <button type="submit">Submit form</button>
        </form>
    </div>
        <x-counter />
        <div is="storm-front" id="item_test">

            <div itemscope oninput="brutto.value = this.getItem().netto * this.getItem().tax">
                <input itemprop="netto" type="text" value="10" />
                <input itemprop="tax" type="text" value="19" />
                <output id="brutto">190</output>
            </div>
        </div>


        <button @click="$refs.text.remove()">Remove Text</button>

        <span x-ref="text">Hello 👋</span>

        <button onclick="text.remove()">Remove Text</button>

        <span id="text">Hello 👋</span>


        <div x-data="{ open: false }">
            <button x-on:click="open = ! open">Toggle Dropdown</button>

            <div x-show="open">
                Dropdown Contents...
            </div>
        </div>

        <button command="toggle-popover" commandfor="dropdown">Toggle Dropdown</button>
        <div id="dropdown" class="border p-8" popover oncommand="position(this, event.source)">
            huhu
        </div>


<!--        <div x-data="{ username: 'calebporzio' }">-->
<!--            <input type="text" v-bind="username" />-->
<!--            Username: <strong x-text="username"></strong>-->
<!--        </div>-->
<!---->
<!---->
<!--        <div oninput="username.value = input_username.value">-->
<!--            <input id="input_username" type="text" />-->
<!--            Username: <strong><output id="username" for="input_username"></output></strong>-->
<!--        </div>-->


        <div x-data="{ username: 'calebporzio' }">
            <input type="text" v-bind="username" />
            Username: <strong x-text="username"></strong>
        </div>

        <div oninput="console.log(querySelector('input'));username.innerHTML = `<strong>${this.closest('input').value}</strong>`">
            <input id="input_username" type="text" />
            Username x-html: <output id="username" for="input_username"></output>
        </div>

        <input oninput="post('url', {include: '.class', debounce: 500})" />
    </div>



  </main>
</x-base>
