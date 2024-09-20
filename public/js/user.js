$(document).ready(function ()
{
    fetchUsers();

    $("#create_user_form").validate({
        rules: {
            name: {
                required: true,
                minlength: 3
            },
            email: {
                required: true,
                email: true
            },
            phone: {
                required: true,
                digits: true,
                minlength: 10,
                maxlength: 15
            },
            role_id: {
                required: true
            },
            description: {
                required: true,
                minlength: 5
            },
            profile_image: {
                required: true,
                extension: "jpg|jpeg|png"
            }
        },
        messages: {
            name: {
                required: "Please enter your name",
                minlength: "Name must be at least 3 characters long"
            },
            email: {
                required: "Please enter a valid email address",
                email: "Please enter a valid email address"
            },
            phone: {
                required: "Please enter your phone number",
                digits: "Phone number must contain only digits",
                minlength: "Phone number must be at least 10 digits",
                maxlength: "Phone number must be no more than 15 digits"
            },
            role_id: {
                required: "Please select the role"
            },
            description: {
                required: "Please enter a description",
                minlength: "Description must be at least 5 characters long"
            },
            profile_image: {
                required: "Please upload a profile image",
                extension: "Only JPG, JPEG, and PNG files are allowed"
            }
        },
        errorPlacement: function (error, element)
        {
            error.appendTo(element.parent().find('.text-red-600'));
        },
        submitHandler: function (form)
        {
            let formData = new FormData(document.getElementById('create_user_form'));
            clearErrors();

            $.ajax({
                url: window.routes.store,
                type: 'POST',
                data: formData,
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                processData: false,
                contentType: false,
                success: function (response)
                {
                    if (response.success)
                    {
                        addUserToTable(response.user);
                        document.getElementById('create_user_form').reset();
                    }
                },
                error: function (xhr)
                {
                    if (xhr.status === 422 && xhr.responseJSON.errors)
                    {
                        displayErrors(xhr.responseJSON.errors);
                    } else
                    {
                        console.error(xhr);
                    }
                }
            });
        }
    });

    $("#submitUserForm").on('click', function (e)
    {
        e.preventDefault();
        if ($("#create_user_form").valid())
        {
            $("#create_user_form").submit();
        }
    });
});

function addUserToTable(user)
{
    let tableBody = document.querySelector('#userTable tbody');
    let row = `<tr>
                <td>${user.name}</td>
                <td>${user.email}</td>
                <td>${user.phone}</td>
                <td>${user.description}</td>
                <td>${user.role_id}</td>
                <td><img src="${user.profile_image}" alt="Profile Image" width="50"></td>
            </tr>`;
    tableBody.innerHTML += row;
}

function fetchUsers()
{
    $.ajax({
        url: window.routes.fetch,
        type: 'GET',
        success: function (response)
        {
            if (response.success)
            {
                response.users.forEach(user =>
                {
                    addUserToTable(user);
                });
            }
        },
        error: function (xhr)
        {
            console.error('Error fetching users:', xhr);
        }
    });
}

function displayErrors(errors)
{

    for (let key in errors)
    {
        let errorElement = document.getElementById(key + 'Error');
        if (errorElement)
        {
            errorElement.textContent = errors[key][0];
        }
    }
}

function clearErrors()
{
    document.querySelectorAll('.text-red-600').forEach(el => el.textContent = '');
}
