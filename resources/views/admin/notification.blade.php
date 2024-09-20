@extends('admin.layout.app')
@section('Contact')
<div class="container mt-5">
    <h1 class="mb-4">Notifications</h1>
  
    <div class="list-group">
      {{-- <% @notifications.each do |notification| %> --}}
        <div class="list-group-item d-flex justify-content-between align-items-start">
          <div class="ms-2 me-auto">
            <div class="fw-bold"><%= notification.header %></div>
            <%= notification.description %>
          </div>
          <small class="text-muted">
            <%= time_ago_in_words(notification.created_at) %> ago
          </small>
        </div>
      <% end %>
    </div>
  </div>
  
@endsection