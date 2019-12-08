<?php use App\User; ?>
@extends('layouts.frontLayout1.front_design')
@section('content')
<!-- Section: Popular Places -->
<section id="popular" class="section section-popular scrollspy">
  <div class="container grey lighten-3 z-depth-2">
    <h3>Messages</h3> 
    <div class="row">
      <div class="col s12 m3">
        <ul class="collection with-header hoverable">
          <li class="collection-item active">
            <div>Inbox
              <a href="{{ url('/messages') }}" class="secondary-content">
                <i class="material-icons">inbox</i>
              </a>
            </div>
          </li>
          <li class="collection-item">
            <div>Sent Messages
              <a href="{{ url('/messages/sent-messages') }}" class="secondary-content">
                <i class="material-icons">send</i>
              </a>
            </div>
          </li>
          <li class="collection-item">
            <div>Compose
              <a href="{{ url('/messages/sent-messages') }}" class="secondary-content">
                <i class="material-icons">create</i>
              </a>
            </div>
          </li>
        </ul>
      </div>
      <div class="col s12 m9">
        <div class="collection hoverable">
          @foreach($resp as $res)
          <?php 
            $sender_name = User::getName($res->sender_id); 
            $encoded_message = encrypt($res->message);
          ?>
          <p class="collection-item">
            <span class="right">
              <a title="View Details" class="modal-trigger" href="#details{{ $res->id }}">
                <i class="material-icons">remove_red_eye</i>
              </a>
              <a title="Reply" href="{{ url('user-details/'.$res->sender_id.'?encoded_message='.$encoded_message) }}">
                <i class="material-icons">reply</i>
              </a>
              <a onclick="return myFunction();" title="Delete Message" href="{{ url('/messages/delete-message/'.$res->id) }}">
                <i class="material-icons">delete</i>
              </a>
            </span>
            From <b>{{ $sender_name }}</b> -- 
            {{ substr($res->message,0,20) }}...<br>
            {{ $res->created_at->diffForHumans() }}
          </p>
          <!-- Modal -->
          <div id="details{{ $res->id }}" class="modal collection">
            <div class="modal-content">
              <h4>Message Details</h4>
              <p><?= nl2br($res->message); ?></p>
              <p>{{ $res->created_at->diffForHumans() }}</p>
            </div>
            <div class="modal-footer">
              <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
            </div>
          </div>
          <!-- End Modal -->
          @endforeach
        </div>
      </div>
    </div>
    {{ $resp->links() }}
  </div>
</section>
@endsection