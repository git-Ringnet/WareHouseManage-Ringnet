<x-navbar :title="$title"></x-navbar>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container">
                <div class="container-fluid box border bg-light">
                    <div class="title-box">
                        Thông tin cơ bản
                    </div>
                    <!-- Small boxes (Stat box) -->
                    <div class="row container">
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box" style="background:#0095F6">
                                <div class="inner">
                                    <div class="total">
                                       {{$totalProducts}}
                                    </div>
                                    <a href="">Tổng số sản phẩm</a>
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box" style="background:#09BD3C">
                                <div class="inner">
                                    <div class="total">
                                        {{$totalProductsStock}}
                                    </div>
                                    <a href="">Sản phẩm sẵn hàng</a>
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box" style="background:#FF9500">
                                <div class="inner">
                                    <div class="total">
                                        {{$products_near_end}}
                                    </div>
                                    <a href="">Sản phẩm gần hết</a>
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box" style="background:#B23333">
                                <div class="inner">
                                    <div class="total">
                                        {{$productsEnd}}
                                    </div>
                                    <a href="">Sản phẩm hết hàng</a>
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                </div><!-- /.container-fluid -->
            </div>
            <div class="container">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row container box-details justify-content-center pt-4 px-2 m-0">
                        <div class="col-lg-5 col-6 mr-lg-3">
                            <!-- small box -->
                            <div class="small-box bg-light pt-2">
                                <div class="inner">
                                   <div class="info">
                                    <div class="total-tilte">
                                      Tổng đơn nhập
                                  </div>
                                  <div class="total">
                                      {{$orders}}
                                  </div>
                                  <p>Trong 30 ngày vừa qua</p>
                                   </div>
                                    <div class="icon-total d-none d-lg-block">
                                      <svg width="94" height="94" viewBox="0 0 94 94" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M74 0H20C8.9543 0 0 8.9543 0 20V74C0 85.0457 8.9543 94 20 94H74C85.0457 94 94 85.0457 94 74V20C94 8.9543 85.0457 0 74 0Z"
                                            fill="#E4F5FF" />
                                        <path
                                            d="M60.41 44.635H69.5C68.9735 39.4743 66.683 34.6532 63.0149 30.9851C59.3468 27.317 54.5257 25.0265 49.365 24.5V33.59C52.1231 34.0606 54.667 35.376 56.6455 37.3545C58.624 39.333 59.9393 41.8769 60.41 44.635Z"
                                            fill="#0095F6" />
                                        <path
                                            d="M47.115 60.385C43.7304 60.3879 40.4684 59.1185 37.976 56.8286C35.4836 54.5387 33.943 51.3956 33.6598 48.0229C33.3765 44.6501 34.3714 41.2942 36.447 38.6207C38.5227 35.9472 41.5273 34.1516 44.865 33.59V24.5C40.6278 24.9254 36.5983 26.5445 33.2448 29.1692C29.8913 31.7939 27.3516 35.3165 25.9207 39.3274C24.4898 43.3383 24.2266 47.673 25.1616 51.8276C26.0966 55.9822 28.1914 59.7861 31.2027 62.7974C34.2139 65.8086 38.0178 67.9034 42.1724 68.8384C46.3271 69.7734 50.6617 69.5102 54.6726 68.0793C58.6836 66.6485 62.2061 64.1087 64.8308 60.7552C67.4555 57.4017 69.0746 53.3722 69.5 49.135H60.41C59.8771 52.2772 58.2504 55.1298 55.8175 57.1885C53.3845 59.2472 50.3021 60.3794 47.115 60.385Z"
                                            fill="#0095F6" />
                                    </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-6 ml-lg-3">
                          <!-- small box -->
                          <div class="small-box bg-light pt-2">
                              <div class="inner">
                                 <div class="info">
                                  <div class="total-tilte">
                                    Tổng đơn xuất
                                </div>
                                <div class="total">
                                    {{$exports}}
                                </div>
                                <p>Trong 30 ngày vừa qua</p>
                                 </div>
                                  <div class="icon-total d-none d-lg-block">
                                    <svg width="94" height="94" viewBox="0 0 94 94" fill="none"
                                      xmlns="http://www.w3.org/2000/svg">
                                      <path
                                          d="M74 0H20C8.9543 0 0 8.9543 0 20V74C0 85.0457 8.9543 94 20 94H74C85.0457 94 94 85.0457 94 74V20C94 8.9543 85.0457 0 74 0Z"
                                          fill="#DEFFE7" />
                                      <path
                                          d="M60.41 44.635H69.5C68.9735 39.4743 66.683 34.6532 63.0149 30.9851C59.3468 27.317 54.5257 25.0265 49.365 24.5V33.59C52.1231 34.0606 54.667 35.376 56.6455 37.3545C58.624 39.333 59.9393 41.8769 60.41 44.635Z"
                                          fill="#09BD3C" />
                                      <path
                                          d="M47.115 60.385C43.7304 60.3879 40.4684 59.1185 37.976 56.8286C35.4836 54.5387 33.943 51.3956 33.6598 48.0229C33.3765 44.6501 34.3714 41.2942 36.447 38.6207C38.5227 35.9472 41.5273 34.1516 44.865 33.59V24.5C40.6278 24.9254 36.5983 26.5445 33.2448 29.1692C29.8913 31.7939 27.3516 35.3165 25.9207 39.3274C24.4898 43.3383 24.2266 47.673 25.1616 51.8276C26.0966 55.9822 28.1914 59.7861 31.2027 62.7974C34.2139 65.8086 38.0178 67.9034 42.1724 68.8384C46.3271 69.7734 50.6617 69.5102 54.6726 68.0793C58.6836 66.6485 62.2061 64.1087 64.8308 60.7552C67.4555 57.4017 69.0746 53.3722 69.5 49.135H60.41C59.8771 52.2772 58.2504 55.1298 55.8175 57.1885C53.3845 59.2472 50.3021 60.3794 47.115 60.385Z"
                                          fill="#09BD3C" />
                                  </svg>
                                  </div>
                              </div>
                          </div>
                      </div>
                        
                    </div>
                    <div class="row container box-details justify-content-center pt-2 px-2 m-0">
                      <div class="col-lg-5 col-6 mr-lg-3">
                          <!-- small box -->
                          <div class="small-box bg-light pt-2">
                              <div class="inner">
                                 <div class="info">
                                  <div class="total-tilte">
                                    Tổng tiền nhập
                                </div>
                                <div class="total">
                                    {{ number_format($sumTotalOrders)}}đ
                                </div>
                                <p>Trong 30 ngày vừa qua</p>
                                 </div>
                                  <div class="icon-total d-none d-lg-block">
                                    <svg width="94" height="94" viewBox="0 0 94 94" fill="none"
                                      xmlns="http://www.w3.org/2000/svg">
                                      <path
                                          d="M74 0H20C8.9543 0 0 8.9543 0 20V74C0 85.0457 8.9543 94 20 94H74C85.0457 94 94 85.0457 94 74V20C94 8.9543 85.0457 0 74 0Z"
                                          fill="#D5FAE8" />
                                      <path
                                          d="M60.41 44.635H69.5C68.9735 39.4743 66.683 34.6532 63.0149 30.9851C59.3468 27.317 54.5257 25.0265 49.365 24.5V33.59C52.1231 34.0606 54.667 35.376 56.6455 37.3545C58.624 39.333 59.9393 41.8769 60.41 44.635Z"
                                          fill="#228176" />
                                      <path
                                          d="M47.115 60.385C43.7304 60.3879 40.4684 59.1185 37.976 56.8286C35.4836 54.5387 33.943 51.3956 33.6598 48.0229C33.3765 44.6501 34.3714 41.2942 36.447 38.6207C38.5227 35.9472 41.5273 34.1516 44.865 33.59V24.5C40.6278 24.9254 36.5983 26.5445 33.2448 29.1692C29.8913 31.7939 27.3516 35.3165 25.9207 39.3274C24.4898 43.3383 24.2266 47.673 25.1616 51.8276C26.0966 55.9822 28.1914 59.7861 31.2027 62.7974C34.2139 65.8086 38.0178 67.9034 42.1724 68.8384C46.3271 69.7734 50.6617 69.5102 54.6726 68.0793C58.6836 66.6485 62.2061 64.1087 64.8308 60.7552C67.4555 57.4017 69.0746 53.3722 69.5 49.135H60.41C59.8771 52.2772 58.2504 55.1298 55.8175 57.1885C53.3845 59.2472 50.3021 60.3794 47.115 60.385Z"
                                          fill="#228176" />
                                  </svg>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-lg-5 col-6 ml-lg-3">
                        <!-- small box -->
                        <div class="small-box bg-light pt-2">
                            <div class="inner">
                               <div class="info">
                                <div class="total-tilte">
                                    Tổng tiền xuất
                              </div>
                              <div class="total">
                                {{ number_format($sumTotalExports)}}đ
                              </div>
                              <p>Trong 30 ngày vừa qua</p>
                               </div>
                                <div class="icon-total d-none d-lg-block">
                                  <svg width="94" height="94" viewBox="0 0 94 94" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M74 0H20C8.9543 0 0 8.9543 0 20V74C0 85.0457 8.9543 94 20 94H74C85.0457 94 94 85.0457 94 74V20C94 8.9543 85.0457 0 74 0Z"
                                        fill="#FFF4DF" />
                                    <path
                                        d="M60.41 44.635H69.5C68.9735 39.4743 66.683 34.6532 63.0149 30.9851C59.3468 27.317 54.5257 25.0265 49.365 24.5V33.59C52.1231 34.0606 54.667 35.376 56.6455 37.3545C58.624 39.333 59.9393 41.8769 60.41 44.635Z"
                                        fill="#FF9500" />
                                    <path
                                        d="M47.115 60.385C43.7304 60.3879 40.4684 59.1185 37.976 56.8286C35.4836 54.5387 33.943 51.3956 33.6598 48.0229C33.3765 44.6501 34.3714 41.2942 36.447 38.6207C38.5227 35.9472 41.5273 34.1516 44.865 33.59V24.5C40.6278 24.9254 36.5983 26.5445 33.2448 29.1692C29.8913 31.7939 27.3516 35.3165 25.9207 39.3274C24.4898 43.3383 24.2266 47.673 25.1616 51.8276C26.0966 55.9822 28.1914 59.7861 31.2027 62.7974C34.2139 65.8086 38.0178 67.9034 42.1724 68.8384C46.3271 69.7734 50.6617 69.5102 54.6726 68.0793C58.6836 66.6485 62.2061 64.1087 64.8308 60.7552C67.4555 57.4017 69.0746 53.3722 69.5 49.135H60.41C59.8771 52.2772 58.2504 55.1298 55.8175 57.1885C53.3845 59.2472 50.3021 60.3794 47.115 60.385Z"
                                        fill="#FF9500" />
                                </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row container box-details justify-content-center pt-2 px-2 m-0">
                      <div class="col-lg-5 col-6 mr-lg-3">
                          <!-- small box -->
                          <div class="small-box bg-light pt-2">
                              <div class="inner">
                                 <div class="info">
                                  <div class="total-tilte">
                                   Tổng tiền tồn kho
                                </div>
                                <div class="total">
                                    {{ number_format($sumTotalInventory)}}đ
                                </div>
                                <p>Trong 30 ngày vừa qua</p>
                                 </div>
                                  <div class="icon-total d-none d-lg-block">
                                    <svg width="94" height="94" viewBox="0 0 94 94" fill="none"
                                      xmlns="http://www.w3.org/2000/svg">
                                      <path
                                          d="M74 0H20C8.9543 0 0 8.9543 0 20V74C0 85.0457 8.9543 94 20 94H74C85.0457 94 94 85.0457 94 74V20C94 8.9543 85.0457 0 74 0Z"
                                          fill="#FAEBEB" />
                                      <path
                                          d="M60.41 44.635H69.5C68.9735 39.4743 66.683 34.6532 63.0149 30.9851C59.3468 27.317 54.5257 25.0265 49.365 24.5V33.59C52.1231 34.0606 54.667 35.376 56.6455 37.3545C58.624 39.333 59.9393 41.8769 60.41 44.635Z"
                                          fill="#B23333" />
                                      <path
                                          d="M47.115 60.385C43.7304 60.3879 40.4684 59.1185 37.976 56.8286C35.4836 54.5387 33.943 51.3956 33.6598 48.0229C33.3765 44.6501 34.3714 41.2942 36.447 38.6207C38.5227 35.9472 41.5273 34.1516 44.865 33.59V24.5C40.6278 24.9254 36.5983 26.5445 33.2448 29.1692C29.8913 31.7939 27.3516 35.3165 25.9207 39.3274C24.4898 43.3383 24.2266 47.673 25.1616 51.8276C26.0966 55.9822 28.1914 59.7861 31.2027 62.7974C34.2139 65.8086 38.0178 67.9034 42.1724 68.8384C46.3271 69.7734 50.6617 69.5102 54.6726 68.0793C58.6836 66.6485 62.2061 64.1087 64.8308 60.7552C67.4555 57.4017 69.0746 53.3722 69.5 49.135H60.41C59.8771 52.2772 58.2504 55.1298 55.8175 57.1885C53.3845 59.2472 50.3021 60.3794 47.115 60.385Z"
                                          fill="#B23333" />
                                  </svg>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                </div><!-- /.container-fluid -->
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
</body>

</html>
