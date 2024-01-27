<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('home') }}" target="_blank" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('logo.png') }}" />
            </span>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ IsActiveOnlyIf(['admin.dashboard']) }}">
            <a href="{{ route('admin.dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">الرئيسية</div>
            </a>
        </li>

        <!-- services -->
        <li class="menu-item {{ IsActiveOnlyIf(['admin.applications.index','admin.applications.create','admin.applications.edit','admin.categories.index','admin.categories.edit']) }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class='menu-icon tf-icons bx bx-dialpad'></i>
                <div data-i18n="Layouts">تضنيفات و نماذج الخدمات</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item {{ IsActiveOnlyIf(['admin.categories.index','admin.categories.edit']) }}">
                    <a href="{{ route('admin.categories.index') }}" class="menu-link">
                        <div data-i18n="Without menu"> تصنيفات الخدمات</div>
                    </a>
                </li>
                <li class="menu-item {{ IsActiveOnlyIf(['admin.applications.index','admin.applications.edit']) }}">
                    <a href="{{ route('admin.applications.index') }}" class="menu-link">
                        <div data-i18n="Without navbar">نماذج الخدمات</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- services -->
        <li class="menu-item {{ IsActiveOnlyIf(['admin.services.index','admin.services.create','admin.services.edit']) }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class='menu-icon tf-icons bx bx-dialpad'></i>
                <div data-i18n="Layouts">الخدمات</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item {{ IsActiveOnlyIf(['admin.services.create']) }}">
                    <a href="{{ route('admin.services.create') }}" class="menu-link">
                        <div data-i18n="Without menu">اضافة</div>
                    </a>
                </li>
                <li class="menu-item {{ IsActiveOnlyIf(['admin.services.index','admin.services.edit']) }}">
                    <a href="{{ route('admin.services.index') }}" class="menu-link">
                        <div data-i18n="Without navbar">عرض</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- projects -->
        <li class="menu-item {{ IsActiveOnlyIf(['admin.projects.index','admin.projects.create','admin.projects.edit']) }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class='menu-icon tf-icons bx bxs-category'></i>
                <div data-i18n="Layouts">المشاريع</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item {{ IsActiveOnlyIf(['admin.projects.create']) }}">
                    <a href="{{ route('admin.projects.create') }}" class="menu-link">
                        <div data-i18n="Without menu">اضافة</div>
                    </a>
                </li>
                <li class="menu-item {{ IsActiveOnlyIf(['admin.projects.index','admin.projects.edit']) }}">
                    <a href="{{ route('admin.projects.index') }}" class="menu-link">
                        <div data-i18n="Without navbar">عرض</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- coupons -->
        {{-- <li class="menu-item {{ IsActiveOnlyIf(['admin.coupons.index','admin.coupons.create','admin.coupons.edit']) }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class='menu-icon tf-icons bx bxs-category'></i>
                <div data-i18n="Layouts">كوبونات الخصم</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item {{ IsActiveOnlyIf(['admin.coupons.create']) }}">
                    <a href="{{ route('admin.coupons.create') }}" class="menu-link">
                        <div data-i18n="Without menu">اضافة</div>
                    </a>
                </li>
                <li class="menu-item {{ IsActiveOnlyIf(['admin.coupons.index','admin.coupons.edit']) }}">
                    <a href="{{ route('admin.coupons.index') }}" class="menu-link">
                        <div data-i18n="Without navbar">عرض</div>
                    </a>
                </li>
            </ul>
        </li> --}}

        <!-- orders -->
        <li class="menu-item {{ IsActiveOnlyIf(['admin.orders.index','admin.orders.create','admin.orders.edit','admin.orders.show']) }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class='menu-icon tf-icons bx bxs-package'></i>
                <div data-i18n="Layouts">الطلبات</div>
                @if(($count_orders = count_unread_model('Order')) > 0)
                    <span class="badge bg-danger bg-sm" style="margin-right: auto;">
                        {{ $count_orders ?: 0 }}
                    </span>
                @endif
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ IsActiveOnlyIf(['admin.orders.index','admin.orders.show','admin.orders.edit']) }}">
                    <a href="{{ route('admin.orders.index') }}" class="menu-link">
                        <div data-i18n="Without navbar">عرض</div>
                    </a>
                </li>
            </ul>
        </li>

         <!-- reviews -->
         <li class="menu-item {{ IsActiveOnlyIf(['admin.discussions','admin.discussions.show']) }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class='menu-icon bx bxs-comment-detail'></i>
                <div data-i18n="Layouts">مناقشات العملاء</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item {{ IsActiveOnlyIf(['admin.discussions.index']) }}">
                    <a href="{{ route('admin.discussions.index') }}" class="menu-link">
                        <div data-i18n="Without navbar">عرض</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- المستخدمين -->
        <li class="menu-item {{ IsActiveOnlyIf(['admin.customers.index','admin.customers.show','admin.customers.services-orders','admin.customers.products-orders']) }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class='menu-icon tf-icons bx bxs-user-pin'></i>
                <div data-i18n="Layouts">المستخدمين</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item {{ IsActiveOnlyIf(['admin.customers.index','admin.customers.show','admin.customers.services-orders','admin.customers.products-orders']) }}">
                    <a href="{{ route('admin.customers.index') }}" href="{{ route('admin.customers.index') }}" class="menu-link">
                        <div data-i18n="Without navbar">عرض</div>
                    </a>
                </li>
            </ul>
        </li>

         <!-- عمليات الدفع -->
         <li class="menu-item {{ IsActiveOnlyIf(['admin.payments.index','admin.payments.create','admin.payments.show']) }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class='menu-icon tf-icons bx bxs-wallet' ></i>
                <div data-i18n="Layouts">عمليات الدفع</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item {{ IsActiveOnlyIf(['admin.payments.index']) }}">
                    <a href="{{ route('admin.payments.index') }}" class="menu-link">
                        <div data-i18n="Without navbar">عرض</div>
                    </a>
                </li>
            </ul>
        </li>

         <!-- اعدادات المنصة-->
         <li class="menu-item {{ IsActiveOnlyIf(['admin.settings.pages.index','admin.settings.general','admin.settings.payments','admin.settings.pages.edit']) }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class='menu-icon tf-icons bx bx-cog'></i>
                <div data-i18n="Layouts">اعدادات المنصة</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item {{ IsActiveOnlyIf(['admin.settings.pages.index','admin.settings.pages.edit']) }}">
                    <a href="{{ route('admin.settings.pages.index') }}" class="menu-link">
                        <div data-i18n="Without menu">اعدادات الصفحات</div>
                    </a>
                </li>
                <li class="menu-item {{ IsActiveOnlyIf(['admin.settings.general']) }}">
                    <a href="{{ route('admin.settings.general') }}" class="menu-link">
                        <div data-i18n="Without navbar">اعدادات عامة </div>
                    </a>
                </li>
                <li class="menu-item {{ IsActiveOnlyIf(['admin.settings.payments']) }}">
                    <a href="{{ route('admin.settings.payments') }}" class="menu-link">
                        <div data-i18n="Without navbar">اعدادات بوابات الدفع </div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- الوسائط-->
        <li class="menu-item {{ IsActiveOnlyIf(['admin.medias.index']) }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class='menu-icon tf-icons bx bx-images' ></i>
                <div data-i18n="Layouts">الوسائط</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item {{ IsActiveOnlyIf(['admin.medias.index']) }}">
                    <a href="{{ route('admin.medias.index') }}" class="menu-link">
                        <div data-i18n="Without navbar"> عرض الوسائط</div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</aside>
