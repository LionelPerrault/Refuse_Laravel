<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
        <div class="navbar-brand-box">
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="<?php echo e(asset('back/assets/images/sms.svg')); ?>" alt="" height="25">
                                </span>
                <span class="logo-lg">
                                    <img src="<?php echo e(asset('back/assets/images/sms.png')); ?>" alt="" height="30">
                                </span>
            </a>

            <a href="<?php echo e(route('admin.dashboard')); ?>" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="<?php echo e(asset('back/assets/images/sms.png')); ?>" alt="" height="58">
                                </span>
                <span class="logo-lg">
                                    <img src="<?php echo e(asset('back/assets/images/sms.png')); ?>" alt="" height="50">
                                </span>
            </a>
        </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>


        </div>
            <div class="dropdown d-inline-block">
            Account Balance:<span style="color:#556ee6;font-weight:bold"> USD 50</span>
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="<?php echo e(asset('back/assets/images/user.png')); ?>"
                         alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ml-1"><?php echo e(Auth::user()->name); ?></span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    
                    <a class="dropdown-item" href="<?php echo e(route('admin.profile.show')); ?>"><i class="bx bx-user font-size-16 align-middle mr-1"></i> Profile</a>
                    <!-- item<a class="dropdown-item d-block" href="#"><span class="badge badge-success float-right">11</span><i class="bx bx-wrench font-size-16 align-middle mr-1"></i> Settings</a>
                    <a class="dropdown-item" href="#"><i class="bx bx-lock-open font-size-16 align-middle mr-1"></i> Lock screen</a>
                    <div class="dropdown-divider"></div>
                    -->
                    <a href="<?php echo e(route('logout')); ?>" class="dropdown-item text-danger"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i> Logout
                    </a>

                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                        <?php echo csrf_field(); ?>
                    </form>
                </div>
            </div>



        </div>
    </div>
</header>
<?php $__env->startComponent('components.incoming-call-controls'); ?>
<?php if (isset($__componentOriginal07ecf8befb67042bd62415ed2e94380a24ab190e)): ?>
<?php $component = $__componentOriginal07ecf8befb67042bd62415ed2e94380a24ab190e; ?>
<?php unset($__componentOriginal07ecf8befb67042bd62415ed2e94380a24ab190e); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php /**PATH /home4/bbagnall/public_html/bulk/test/bulk_sms/resources/views/back/inc/header.blade.php ENDPATH**/ ?>