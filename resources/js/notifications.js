// open-close notifications
let notification = document.getElementById("notification");
let open_notify = document.getElementById("open_notify");
let close_notify = document.getElementById("close_notify");

open_notify.onclick = () => {
    notification.classList.add("left-0");
    notification.classList.remove("-left-full");
};

close_notify.onclick = () => {
    notification.classList.remove("left-0");
    notification.classList.add("-left-full");
};

//realtime pusher

if (document.documentElement.lang == 'vi') {
    var newOrder = 'Có đơn đặt hàng mới từ ';
} else {
    var newOrder = 'Got a new order from ';
}

var notificationsCount = $("#count-notify").data('count');

var pusher = new Pusher('55797b70222e7b49e41a', {
    encrypted: true,
    cluster: "ap1"
});
var channel = pusher.subscribe('notifications-order');
channel.bind('NotificationEvent', function (e) {
    var url = window.location.protocol + "//" + window.location.host + '/admin/notifications/' + e.id;
    var formNotification = `<form action="`
    formNotification += url
    formNotification += `" method="post" class="flex items-center justify-between bg-blue-50 p-3 mt-8">
        <input type="hidden" name="_method" value="PATCH">
        <input type="hidden" name="_token" value="${$('meta[name="csrf-token"]').attr('content')}">
        <button type="submit" class="w-full rounded flex items-center" data-id ="${e.id}">
            <div tabindex="0" aria-label="heart icon" role="img"
                class="text-green-400 focus:outline-none w-8 h-8 border rounded-full border-gray-200 flex items-center justify-center">
                <i class="fas fa-donate"></i>
            </div>
            <div class="pl-3">
                <p tabindex="0" class="focus:outline-none text-sm leading-none capitalize">
                    ${newOrder + e.content}
                </p>
                <p tabindex="0" class="focus:outline-none float-left text-xs pt-1 text-gray-500">`
    formNotification += moment().fromNow()
    formNotification += `
                </p>
            </div>
        </button>
        <i class="fas fa-circle text-red-500" style="font-size: 6px"></i>
    </form>
    `;

    $('.list-notification').prepend(formNotification);

    notificationsCount++;
    $("#count-notify").attr('data-count', notificationsCount);
    $("#open_notify").find('.notify-count').text(notificationsCount);
    $("#open_notify").show();
});

// tabs
const tabs = document.getElementById("tabs");
const tab = document.querySelectorAll(".tab");
const panel = document.querySelectorAll(".tab-content");

function onTabClick(event) {

    for (let i = 0; i < tab.length; i++) {
        tab[i].classList.remove("active");
    }

    for (let i = 0; i < panel.length; i++) {
        panel[i].classList.remove("active");
    }
    event.target.classList.add('active');
    let classString = event.target.getAttribute('data-target');
    document.getElementById('panels').getElementsByClassName(classString)[0].classList.add("active");
}

for (let i = 0; i < tab.length; i++) {
    tab[i].addEventListener('click', onTabClick, false);
}
