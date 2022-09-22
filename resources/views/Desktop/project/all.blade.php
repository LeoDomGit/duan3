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
@section('title','Quản lý dự án')
@section('main_container')
    <div class="wrapper">
        <div class="wrapper mt-3">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>#</td>
                        <td>Tên dự án</td>
                        <td>Mô tả dự án</td>
                        <td>Tình trạng</td>
                        <td>Ngày tạo</td>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1;?>
                    @foreach ($allProjects as $item)
                    <tr>
                        <td><?=$i++?></td>
                        <td>{{$item->project_name}}</td>
                        <td>{{$item->description}}</td>
                        <td><?php if($item->status==1){echo "Mới khởi tạo";}?></td>
                        <td><?php echo date('H:i d/m/yy',strtotime($item->created_at)) ?></td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
        </div>
    </div>
@endsection
