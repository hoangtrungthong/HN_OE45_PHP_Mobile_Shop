$(document).ready(function () {
    var html = `
    <div class="child flex flex-wrap gap-2 sm:col-span-8">
        <div class="w-1/5 col-span-6 sm:col-span-6 lg:col-span-2">
            <input type="text" name="quantity[]" id="quantity"
                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
        </div>
        <div class="w-1/5 col-span-6 sm:col-span-6 lg:col-span-2">
            <select id="color" name="color_id[]" autocomplete="color"
            class="mt-1 block col-span-8 w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">`; +
    window.colors.forEach(e => {
        html += `<option style="background: ` + e.name + `" value="` + e.id + `">` + e.name + `</option>`
    });
    html += `
            </select>
        </div>
        <div class="w-1/5 col-span-6 sm:col-span-3 lg:col-span-2">
        <select id="memory" name="memory_id[]" autocomplete="memory"
            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">`
    window.memories.forEach(el => {
        html += `<option style="background: ` + el.rom + `" value="` + el.id + `">` + el.rom + `</option>`
    })
    html += `
            </select>
        </div>
        <div class="w-1/5 col-span-6 sm:col-span-3 lg:col-span-2">
            <input type="text" name="price[]" id="price" autocomplete="postal-code"
                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
        </div>
        <p class="removeEl mt-2 inline-flex justify-center items-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 cursor-pointer">
            <i class="fas fa-times-circle"></i>
        </p>
    </div>`;

    $("#add").click(function () {
        $(".parent").append(html);
    });

    $(".parent").on('click', '.removeEl', function () {
        $(this).parent().remove(".child");
    });
})
