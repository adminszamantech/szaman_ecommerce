
<li class="dashboard_permission">
    <a href="{{ route('backend.dashboard') }}" @if(request()->is('admin/dashboard')) style="background: rgba(0, 0, 0, 0.1)" @endif>
        <i class="fal fa-globe"></i>
        <span class="nav-link-text" >Dashboard </span>
    </a>
</li>

<li class="dashboard_permission">
    <a href="{{ route('backend.slider.index') }}" @if(request()->is('admin/slider')) style="background: rgba(0, 0, 0, 0.1)" @endif>
        <i class="fal fa-globe"></i>
        <span class="nav-link-text">Slider</span>
    </a>
</li>
<li class="dashboard_permission">
    <a href="{{ route('backend.category.index') }}" @if(request()->is('admin/category')) style="background: rgba(0, 0, 0, 0.1)" @endif>
        <i class="fal fa-globe"></i>
        <span class="nav-link-text">Category </span>
    </a>
</li>
<li class="dashboard_permission">
    <a href="{{ route('backend.subcategory.index') }}" @if(request()->is('admin/subcategory')) style="background: rgba(0, 0, 0, 0.1)" @endif>
        <i class="fal fa-globe"></i>
        <span class="nav-link-text" >Subcategory </span>
    </a>
</li>

<li class="dashboard_permission">
    <a href="{{ route('backend.brand.index') }}" @if(request()->is('admin/brand')) style="background: rgba(0, 0, 0, 0.1)" @endif title="Brand">
        <i class="fal fa-globe"></i>
        <span class="nav-link-text">Brand </span>
    </a>
</li>
<li class="dashboard_permission">
    <a href="{{ route('backend.attribute.index') }}" @if(request()->is('admin/attribute')) style="background: rgba(0, 0, 0, 0.1)" @endif >
        <i class="fal fa-globe"></i>
        <span class="nav-link-text" >Attribute </span>
    </a>
</li>
<li class="dashboard_permission">
    <a href="{{ route('backend.customer.index') }}" @if(request()->is('admin/customer')) style="background: rgba(0, 0, 0, 0.1)" @endif >
        <i class="fal fa-globe"></i>
        <span class="nav-link-text" >Customer </span>
    </a>
</li>

<li class="employee_permission">
    <a title="Product"  @if(request()->is('admin/product') || request()->is('admin/product/create')) style="background: rgba(0, 0, 0, 0.1)" @endif class=" waves-effect waves-themed" aria-expanded="false">
        <i class="fal fa-info-circle"></i>
        <span class="nav-link-text" >Product</span>
    </a>
    <ul style="display: none;" >
        <li>
            <a href="{{ route('backend.product.create') }}" class=" waves-effect waves-themed">
                <span class="nav-link-text">Add Product</span>
            </a>
        </li>
        <li>
            <a href="{{ route('backend.product.index') }}" class=" waves-effect waves-themed">
                <span class="nav-link-text" >Product List</span>
            </a>
        </li>
    </ul>
</li>
<li class="employee_permission">
    <a title="Product"  @if(request()->is('admin/order/*')) style="background: rgba(0, 0, 0, 0.1)" @endif class=" waves-effect waves-themed" aria-expanded="false">
        <i class="fal fa-info-circle"></i>
        <span class="nav-link-text" >Orders</span>
    </a>
    <ul style="display: none;" >
        <li>
            <a href="{{ route('backend.order.index') }}" class=" waves-effect waves-themed">
                <span class="nav-link-text">Placed Order</span>
            </a>
        </li>
    </ul>
</li>
<li class="employee_permission">
    <a title="Product" @if(request()->is('admin/shipping-charge') || request()->is('admin/product/create')) style="background: rgba(0, 0, 0, 0.1)" @endif class=" waves-effect waves-themed" aria-expanded="false">
        <i class="fal fa-info-circle"></i>
        <span class="nav-link-text" >Settings</span>
    </a>
    <ul style="display: none;" >
        <li>
            <a href="{{ route('backend.shipping-charge.index') }}" class=" waves-effect waves-themed">
                <span class="nav-link-text" >Shipping Charge</span>
            </a>
        </li>
        <li>
            <a href="{{ route('backend.setting.sslcommerz') }}" class=" waves-effect waves-themed">
                <span class="nav-link-text">SSLCommerz</span>
            </a>
        </li>
        <li>
            <a href="{{ route('backend.setting.site_setting') }}" class=" waves-effect waves-themed">
                <span class="nav-link-text">Site Setting</span>
            </a>
        </li>
    </ul>
</li>
<li>
    <a href="{{ route('backend.admin.logout') }}" id="logoutButton">
        <i class="fal fa-sign-out"></i>
        <span class="nav-link-text">Logout</span>
    </a>
</li>
<!-- Example of open and active states -->


