
// $.fn.modal.Constructor.prototype.enforceFocus = function() {};

$('#detail-checkbox').on('change', function () {
    let isChecked = $(this).is(':checked');
    console.log('isChecked', isChecked);
    if (isChecked) $('.ticket-detail').removeClass('d-none');
    else $('.ticket-detail').addClass('d-none');
})

// friend list search.
$('.userSearch').select2({
    placeholder: 'Select Friends',
    // tags: true,
    ajax: {
        url: "{{ route('client.search.users') }}",
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
            return {
                results: $.map(data, function (item) {
                    return {
                        text: item.user_name,
                        id: item.user_name
                    }
                })
            };
        },
        cache: true
    }
});

// tag list search.
$('.tagSearch').select2({
    placeholder: 'Select Tags',
    tags: true,
    ajax: {
        url: "{{ route('client.search.tags') }}",
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
            return {
                results: $.map(data, function (item) {
                    return {
                        text: item.user_name,
                        id: item.user_name
                    }
                })
            };
        },
        cache: true
    }
});

$('.like-post').on('click', function () {

    let userId = @JSON($user->id);
    let postid = $(this).attr('p-id');
    let postUser = $(this).attr('p-user');
    let currentCount = $(this).attr('pl-count');
    currentCount = parseInt(currentCount) + 1;
    $(this).html('<i class="icon ion-thumbsup"></i>' + currentCount);
    let route = "{{ route('client.like.user.post') }}"
    likePost(postid, route)
})
$('.dislike-post').on('click', function () {
    console.log('dislike clicked');
    let postid = $(this).attr('p-id');
    console.log('postId', postid);
    let currentCount = $(this).attr('pd-count');
    console.log('currentCOunt ', currentCount);
    $(this).html('<i class="fa fa-thumbs-down"></i>' + parseInt(currentCount) + 1);
    let route = "{{ route('client.dislike.user.post') }}"
    likePost(postid, route)
})

function likePost(postId, route) {
    $.ajax({
        type: 'POST',
        url: route,
        data: {
            "_token": "{{ csrf_token() }}",
            'post_id': postId,
        },
        success: function (data) {
            return true;
        }
    });
}
