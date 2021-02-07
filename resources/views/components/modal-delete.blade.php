<dialog id="deleteConfirme" class="bg-transparent z-0 relative">
    <div class="p-7 flex justify-center items-center fixed left-0 top-0 w-full h-full bg-gray-900 bg-opacity-50 z-50 transition-opacity duration-300 opacity-0">
        <div class="bg-white flex rounded-lg w-1/2 relative">
            <div class="flex flex-col items-start w-full">
                <div class="p-7 flex  w-full items-center justify-between p-2">
                    <div class="text-red-600 font-bold text-lg">
                        Danger
                    </div>
                    <div class="justify-end">
                        <svg onclick="modalClose('deleteConfirme')" class="ml-auto fill-current text-gray-700 w-5 h-5 cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z" />
                        </svg>
                    </div>
                </div>

                <div class="px-7 overflow-x-hidden overflow-y-auto";>
                    <p id="messageDelete">

                    </p>
                </div>

                <div class="p-7 flex justify-end items-center w-full">
                    <button type="button" onclick="modalClose('deleteConfirme')" class="font-semibold p-2 mr-2 w-32 rounded-full transition bg-gray-100 rounded-full shadow ripple hover:shadow-lg hover:bg-gray-400 focus:outline-none">
                        Cancel
                    </button>

                    <form id="formDelete" action="" method="POST" class="form-delete">
                        @csrf
                        @method('DELETE')

                        <button
                            class="bg-red-600 font-semibold text-white p-2 w-32 rounded-full hover:bg-red-700 focus:outline-none focus:ring shadow-lg hover:shadow-none transition-all duration-300"
                            @click="showModal1 = false"
                        >
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</dialog>

<script>
    function openModal(key, valueName, route) {
        let message = 'Are you sure you want to delete ' + valueName + '?';

        document.getElementById('messageDelete').innerHTML = message;
        document.getElementById('formDelete').action = route;

        document.getElementById(key).showModal();
        document.body.setAttribute('style', 'overflow: hidden;');
        document.getElementById(key).children[0].scrollTop = 0;
        document.getElementById(key).children[0].classList.remove('opacity-0');
        document.getElementById(key).children[0].classList.add('opacity-100')
    }

    function modalClose(key) {
        document.getElementById(key).children[0].classList.remove('opacity-100');
        document.getElementById(key).children[0].classList.add('opacity-0');
        setTimeout(function () {
            document.getElementById(key).close();
            document.body.removeAttribute('style');
            document.getElementById('messageDelete').innerHTML = '';
            document.getElementById('formDelete').action = '';
        }, 100);
    }
</script>
