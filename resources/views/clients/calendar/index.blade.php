<x-layout>

    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            {{-- <nav class="tabs tabs-bordered" aria-label="Tabs" role="tablist" aria-orientation="horizontal">
                <button type="button" class="tab active-tab:tab-active " id="tabs-basic-item-1" data-tab="#tabs-basic-1"
                    aria-controls="tabs-basic-1" role="tab" aria-selected="true">
                    Custom Exercises
                </button>
                <button type="button" class="tab active-tab:tab-active active" id="tabs-basic-item-2"
                    data-tab="#tabs-basic-2" aria-controls="tabs-basic-2" role="tab" aria-selected="false">
                    Exercise Databese
                </button>
            </nav> --}}
            <span></span>
            <h3 class="font-bold text-black text-lg">Your calendar</h3>
        </div>


        <div class="mt-5">
            <div class="card min-h-screen">
                <div class="card-body">
                    <div id="calendar-container" class="bg-white p-4 rounded shadow"></div>


                    <div id="schedule-workout-modal" class="hs-overlay hidden w-full h-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto">
                        <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
                            <div class="flex flex-col bg-white border shadow-sm rounded-xl">
                                <div class="flex justify-between items-center py-3 px-4 border-b">
                                    <h3 class="font-bold text-gray-800">Призначити тренування</h3>
                                    <button type="button" class="inline-flex flex-shrink-0 justify-center items-center h-8 w-8 rounded-full text-gray-500 hover:text-gray-800 focus:outline-none" data-hs-overlay="#schedule-workout-modal">
                                        <span class="text-gray-500">Закрити</span>
                                        <svg class="flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                                <div class="p-4 overflow-y-auto">
                                    <form id="schedule-workout-form">
                                        <div class="mb-4">
                                            <label for="scheduled-date" class="block text-sm font-medium text-gray-700">Дата</label>
                                            <input type="date" id="scheduled-date" name="scheduled_date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" readonly>
                                        </div>
                                        <div class="mb-4">
                                            <label for="workout-select" class="block text-sm font-medium text-gray-700">Тренування</label>
                                            <select id="workout-select" name="workout_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                                <option value="">Виберіть тренування</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Призначити</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

    </div>

</x-layout>
