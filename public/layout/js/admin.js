$(document).ready(function () {
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
    addNewRole();
    addUser();
});
// ===================================

function addUser(){
    $("#addUserbtn").click(function (e) {
        e.preventDefault();
        var usernamenew=$("#usernamenew").val().trim();
        var emailnew=$("#emailnew").val().trim();
        var idRole = $("#userRoleID option:selected").val();
        if(!emailnew.match(/(.+)@(leontec.co+)\.(jp)/i)){
            Swal.fire({
                icon:'error',
                text:'Email không hợp lệ',
            });
        }else if(usernamenew==''){
            Swal.fire({
                icon:'error',
                text:'Username không được bỏ trống',
            });
        }else if(isNaN(idRole)==true){
            Swal.fire({
                icon:'error',
                text:'Dữ liệu không hợp lệ',
            });
        }else{
            $.ajax({
                url: 'http://127.0.0.1:3000/api/addUser',
                type: "POST",
                data: {
                    username:usernamenew,
                    email:emailnew,
                    roleId:idRole
                },
                success: function (response) {
                    if(response.status==401){
                      if(response.error=='exist'){
                        Swal.fire({
                            icon:'error',
                            text:'Đã tồn tại tài khoản',
                          })
                      }else{
                        Swal.fire({
                            icon:'error',
                            text:'Thiếu thông tin tài khoản',
                          })
                      }
                    }else if(response.status==200){
                      Swal.fire({
                        icon:'success',
                        text:'Đã thêm tài khoản thành công !',
                      }).then(()=>{
                        window.location.reload();
                      })
                    }
                }
            })
        }
    });
}

// ===================================
function deleteRole($id){
  Swal.fire({
    icon:'question',
    text: 'Bạn muốn xóa loại tài khoản',
    showDenyButton: true,
    showCancelButton: true,
    confirmButtonText: 'Đúng',
    denyButtonText: `Không xóa`,
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      let idRole=$id
      $.ajax({
        url: 'http://127.0.0.1:3000/api/deleteRole',
        type: "POST",
        data: {
          idRole:idRole
        },
        success: function (response) {
            if(response.status==400){
              Swal.fire({
                icon:'success',
                text:'Không thể xóa loại tài khoản?',
              })
            }else if(response.status==200){
              Swal.fire({
                icon:'success',
                text:'Đã xóa thành công !',
              }).then(()=>{
                window.location.reload();
              })
            }
        }
    })
    } else if (result.isDenied) {
      Swal.fire('Không xóa', '', 'success')
    }
  })
}

// ====================================

function addNewRole(){
    $('#submitRole').click(function (e) {
        e.preventDefault();
        var newRole = $("#newRole").val().trim();
        if(newRole==''){
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener('mouseenter', Swal.stopTimer)
                  toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
              })

              Toast.fire({
                icon: 'error',
                title: 'Role name is empty'
              })
        }else{
          $.ajax({
            url: 'http://127.0.0.1:3000/api/addRole',
            type: "POST",
            data: {
              roleName: newRole,
            },
            success: function (response) {
                if(response.status==401){
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                          toast.addEventListener('mouseenter', Swal.stopTimer)
                          toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                      })

                      Toast.fire({
                        icon: 'error',
                        title: "Đã tồn tại loại tài khoản"
                      }).then(()=>{
                        window.location.reload();
                      })
                }else if(response.status==400){
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                          toast.addEventListener('mouseenter', Swal.stopTimer)
                          toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                      })

                      Toast.fire({
                        icon: 'error',
                        title: 'Dữ liệu không hợp lệ'
                      }).then(()=>{
                        window.location.reload();
                      })
                }else if(response.status==200){
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                          toast.addEventListener('mouseenter', Swal.stopTimer)
                          toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                      })

                      Toast.fire({
                        icon: 'success',
                        title: 'Thêm mới thành công'
                      }).then(()=>{
                        window.location.reload();
                      })
                }
            }
        })
        }
    });
}

// ====================================

function editRole($id){
  let idRole=$id;
  $("#submitNewRolebtn").click(function (e) {
    e.preventDefault();
    let newUserRole= $("#RoleNameNew").val().trim();
    if(newUserRole!=''){
      $.ajax({
        url: 'http://127.0.0.1:3000/api/editRole',
        type: "POST",
        data: {
          roleName: newUserRole,
          idRole:idRole
        },
        success: function (response) {
            if(response.status==401){
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                      toast.addEventListener('mouseenter', Swal.stopTimer)
                      toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                  })

                  Toast.fire({
                    icon: 'error',
                    title: "Đã tồn tại loại tài khoản"
                  }).then(()=>{
                    window.location.reload();
                  })
            }else if(response.status==400){
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                      toast.addEventListener('mouseenter', Swal.stopTimer)
                      toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                  })

                  Toast.fire({
                    icon: 'error',
                    title: 'Dữ liệu không hợp lệ'
                  }).then(()=>{
                    window.location.reload();
                  })
            }else if(response.status==200){
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                      toast.addEventListener('mouseenter', Swal.stopTimer)
                      toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                  })

                  Toast.fire({
                    icon: 'success',
                    title: 'Thay đổi thành công'
                  }).then(()=>{
                    window.location.reload();
                  })
            }
        }
    })
    }
  });
}
