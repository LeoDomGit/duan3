<style>
    .swal2-container {
      z-index: 2000 !important;
    }
    .wrapper{
        width: 95%;
        margin: 0px auto
    }
  </style>
  @extends('layout.layout1')
  @section('title','Quản lý team')
  @section('main_container')

      {{-- Modal Role --}}
      <div class="modal fade" id="AddNewUserMD" tabindex="-1" aria-labelledby="AddNewUserMDLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="AddNewUserMDLabel">Add New Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                @csrf
                <input type="text" class="form-control" id="newRole" placeholder="New Role Name">
              </div>
              <div class="modal-footer">
                {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                <button type="button" id="submitRole" class="btn btn-primary">Thêm</button>
              </div>
            </div>
          </div>
        </div>
            <!-- Modal UserRole -->
            <div class="modal fade" id="loaiTKMD" tabindex="-1" aria-labelledby="loaiTKMDLabel" aria-hidden="true">
              <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="loaiTKMDLabel">Loại tài khoản</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <table class="table table-success table-striped">
                      <thead>
                        <th>#</th>
                        <th>Tên loại tài khoản</th>
                        <th>Lựa chọn</th>
                      </thead>
                      <tbody>
                        <?php
                          $i=1;
                          ?>
                        @foreach ($userRole as $item)
                            <tr>
                              <td>
                                <?=$i++?>
                              </td>
                              <td>
                                {{$item->roleName}}
                              </td>
                              <td>
                                <button class="btn btn-danger btn-sm" onclick="deleteRole({{$item->id}})">Xóa</button>
                                <button data-bs-toggle="modal" data-bs-target="#editModal" onclick="editRole({{$item->id}})" class="btn btn-warning btn-sm">Sửa</button>
                              </td>
                            </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            {{--  --}}

        {{-- ========================= --}}
        <div class="modal fade" id="editModal" tabindex="3" aria-labelledby="editModalLabel" aria-hidden="false">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Sửa Loại tài khoản</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <input type="text" placeholder="Loại tài khoản mới " class="form-control" id="RoleNameNew">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="button" id="submitNewRolebtn" class="btn btn-primary">Lưu</button>
              </div>
            </div>
          </div>
        </div>
        {{-- Modal Thêm tài khoản  --}}
        <div class="modal fade" id="addUserMd" tabindex="-1" aria-labelledby="addUserMdLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="addUserMdLabel">Thêm tài khoản</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <input type="text" class="form-control" placeholder="username" id="usernamenew"><br>
                <input type="text" class="form-control" placeholder="Email" id="emailnew">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="button" id="addUserbtn" class="btn btn-primary">Thêm</button>
              </div>
            </div>
          </div>
        </div>

        {{-- ================================================================ --}}
        <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
        {{-- End Modal --}}
        <div class="wrapper mt-3">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>#</td>
                        <td>Username</td>
                        <td>Tình trạng</td>
                        <td>Ngày tạo</td>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1;?>
                    @foreach ($usersArr as $item)
                    <tr>
                        <td><?=$i++?></td>
                        <td><p style="cursor: pointer;">{{$item->username}}</p></td>
                        <td><?php if($item->status==1){echo "Đang hoạt động";}else{echo "Đang khóa";}?></td>
                        <td><?php echo date('H:i d/m/yy',strtotime($item->created_at)) ?></td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
        </div>

  @endsection
