    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sảm Phẩm</h1>
          </div>    
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= DOCUMENT_ROOT. "/admin/home"?>">Trang chủ</a></li>
              <li class="breadcrumb-item active">Sản phẩm</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
                <div class="card-header">
                  <div class="d-flex justify-content-between align-items-center">
                    <h5>Danh sách sản phẩm</h5>
                    <a class="btn btn-primary" href="<?=DOCUMENT_ROOT?>/admin/items/create">Thêm sản phẩm</a>
                  </div>
                </div>

              <div class="card-body">
                <table id="Mytable" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá sản phẩm</th>
                    <th>Chi tiết sản phẩm</th>
                    <th>Loại sản phẩm</th>
                    <th>Hình ảnh sản phẩm</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($data['items'] as $index => $items) : ?>
                        <tr>
                            <td><?=$index +1 ?></td>
                            <td><?=$items['name']?></td>
                            <td><?=$items['price']?></td>
                            <td><?=$items['description']?></td>
                            <td><?=$items['id_sport_type']?></td>
                            <td><img style="max-width: 100px;" class="rounded img-thumbnail" src="<?= IMAGES_ITEMS_URL ?>/<?= $items['image']?>" alt="image items"/></td>
                            <td>
                            <div class=" btn-group" role="group" aria-label="Basic example">
                                <a href="<?=DOCUMENT_ROOT?>/admin/items/edit/<?=$items['id']?>"><button type="button" class="btn btn-info"><i class="fas fa-tools"></i> Sửa</button></a>
                                <button type="button" class="ml-1 btn btn-danger identifyingClass" data-toggle="modal" data-target="#modal-delete" data-id="my_id_value"><i class="far fa-trash-alt"></i> Xóa</button>
                            </div>
                            </td>
                        </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>

 <!-- modal -->
 <div class="modal fade" id="modal-delete" aria-labelledby="my_modalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Delete Cake</h4>
                <button type="button" class="close" data-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">
                <p>Delete <?= $cake['name']?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <a href="<?=DOCUMENT_ROOT?>/admin/cakes/delete/<?=$cake['id']?>"><button type="button" class="btn btn-success">OK bạn ê</button></a>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->

<script type="text/javascript">
    $(function () {
        $(".identifyingClass").click(function () {
            var my_id_value = $(this).data('id');
            $(".modal-body #hiddenValue").val(my_id_value);
        })
    });
</script>