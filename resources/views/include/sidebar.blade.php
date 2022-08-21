<div class="sidebar">
  <div class="list-group" id="list-tab" role="tablist">
     <!--  <a class="list-group-item list-group-item-action {{ (request()->is('user/dashboard')) ? 'active' : '' }}" role="tab"  href="{{ url('/user/dashboard') }}"  style="border: 1px solid #dddddd;">Dashboard</a> -->
      <a class="list-group-item list-group-item-action {{ (request()->is('user/listing')) ? 'active' : '' }}" role="tab"  href="{{ url('/user/listing') }}" style="border: 1px solid #dddddd;">My Listing</a>
      <!-- <a class="list-group-item list-group-item-action {{ (request()->is('user/register')) ? 'active' : '' }}" role="tab"  href="{{ url('/user/register') }}" style="border: 1px solid #dddddd;">Add User</a> -->
      <a class="list-group-item list-group-item-action {{ (request()->is('user/earning')) ? 'active' : '' }}" role="tab"  href="{{ url('/user/earning') }}" style="border: 1px solid #dddddd;">My Earning</a>
      <a class="list-group-item list-group-item-action {{ (request()->is('user/profile')) ? 'active' : '' }}" role="tab" href="{{ url('/user/profile') }}" style="border: 1px solid #dddddd;">My Profile</a>
      <a class="list-group-item list-group-item-action {{ (request()->is('user/review')) ? 'active' : '' }}" role="tab" href="{{ url('/user/review') }}" style="border: 1px solid #dddddd;">My Review</a>
      <!-- <a class="list-group-item list-group-item-action {{ (request()->is('user/changepasswpord')) ? 'active' : '' }}" role="tab" href="#" style="border: 1px solid #dddddd;">Change Password</a> -->
      <!-- <a class="list-group-item list-group-item-action" role="tab" href="#list-settings" >Change Password</a> -->
      <a class="list-group-item list-group-item-action" role="tab" href="{{ url('/user/logout') }}" style="border: 1px solid #dddddd;" >Logout</a>
    </div>
</div>