<?php

namespace App\Http\Controllers;

use App\Models\UserApp;
use Illuminate\Http\Request;

class FriendsManagmentController extends Controller
{
    public function sendFriendRequest(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required'
        ]);

        $recipient = UserApp::where('id', $request->user_id)->first();
        if(is_null($recipient)){
            return response()->json([
                'status' => false,
                'message' => 'Can\'t find recipient.',
                'code' => 1004,
            ]);
        }

        $user = $request->user();
        $user->befriend($recipient);
        return response()->json([
            'status' => true,
            'message' => 'Friend request sent already.',
            'code' => 1005,
        ]);
    }

    public function checkFriendshipStatus(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required'
        ]);

        $friend = UserApp::where('id', $request->user_id)->first();
        if(is_null($friend)){
            return response()->json([
                'status' => false,
                'message' => 'Can\'t find recipient.',
                'code' => 1004,
            ]);
        }

        $user = $request->user();
        return response()->json([
            'status' => true,
            'message' => 'Frienship status success.',
            'code' => 1005,
            'is_friend'=> $user->isFriendWith($friend)
        ]);
    }

    public function checkFriendRequestStatus(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required'
        ]);

        $sender = UserApp::where('id', $request->user_id)->first();
        if(is_null($sender)){
            return response()->json([
                'status' => false,
                'message' => 'Can\'t find recipient.',
                'code' => 1004,
            ]);
        }

        $user = $request->user();
        return response()->json([
            'status' => true,
            'message' => 'Frienship status success.',
            'code' => 1005,
            'friend_request_sent'=> $user->hasFriendRequestFrom($sender)
        ]);
    }

    public function checkFriendRequestStatusForOthers(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required'
        ]);

        $sender = UserApp::where('id', $request->user_id)->first();
        if(is_null($sender)){
            return response()->json([
                'status' => false,
                'message' => 'Can\'t find recipient.',
                'code' => 1004,
            ]);
        }

        $user = $request->user();
        return response()->json([
            'status' => true,
            'message' => 'Frienship status success.',
            'code' => 1005,
            'friend_request_sent'=> $user->hasSentFriendRequestTo($sender)
        ]);
    }

    public function acceptFriendRequest(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required'
        ]);

        $sender = UserApp::where('id', $request->user_id)->first();
        if(is_null($sender)){
            return response()->json([
                'status' => false,
                'message' => 'Can\'t find recipient.',
                'code' => 1004,
            ]);
        }

        $user = $request->user();
        $user->acceptFriendRequest($sender);

        return response()->json([
            'status' => true,
            'message' => 'Request Accepted.',
            'code' => 1006,
        ]);
    }

    public function rejectFriendRequest(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required'
        ]);

        $sender = UserApp::where('id', $request->user_id)->first();
        if(is_null($sender)){
            return response()->json([
                'status' => false,
                'message' => 'Can\'t find recipient.',
                'code' => 1004,
            ]);
        }

        $user = $request->user();
        $user->denyFriendRequest($sender);
        return response()->json([
            'status' => true,
            'message' => 'Request rejected successfully.',
            'code' => 1007
        ]);
    }

    public function unfriendUser(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required'
        ]);

        $sender = UserApp::where('id', $request->user_id)->first();
        if(is_null($sender)){
            return response()->json([
                'status' => false,
                'message' => 'Can\'t find recipient.',
                'code' => 1004,
            ]);
        }

        $user = $request->user();
        $user->unfriend($sender);
        return response()->json([
            'status' => true,
            'message' => 'Unfriend successfully.',
            'code' => 1008
        ]);
    }

    public function getSingleFrienship(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required'
        ]);

        $sender = UserApp::where('id', $request->user_id)->first();
        if(is_null($sender)){
            return response()->json([
                'status' => false,
                'message' => 'Can\'t find recipient.',
                'code' => 1004,
            ]);
        }

        $user = $request->user();
        return response()->json([
            'status' => true,
            'message' => 'Get friendship successful.',
            'code' => 1009,
            'data' => $user->getFriendship($sender)
        ]);
    }

    public function getAllFrienship(Request $request)
    {
        $user = $request->user();
        return response()->json([
            'status' => true,
            'message' => 'Get friendship successful.',
            'code' => 1009,
            'data' => $user->getAllFriendships()
        ]);
    }

    public function getPendingFriendships(Request $request)
    {
        $user = $request->user();
        return response()->json([
            'status' => true,
            'message' => 'Get pending friendship successful.',
            'code' => 1009,
            'data' => $user->getPendingFriendships()
        ]);
    }

    public function getAcceptedFriendships(Request $request)
    {
        $user = $request->user();
        return response()->json([
            'status' => true,
            'message' => 'Get accept friendship successful.',
            'code' => 1009,
            'data' => $user->getAcceptedFriendships()
        ]);
    }

    public function getFriendRequests(Request $request)
    {
        $user = $request->user();
        return response()->json([
            'status' => true,
            'message' => 'Get pendding friend requests.',
            'code' => 1009,
            'data' => $user->getFriendRequests()
        ]);
    }

    public function getFriendsCount(Request $request)
    {
        $user = $request->user();
        return response()->json([
            'status' => true,
            'message' => 'Get friends count success.',
            'code' => 1009,
            'count' => $user->getFriendsCount()
        ]);
    }

    public function getFriends(Request $request)
    {
        $user = $request->user();
        return response()->json([
            'status' => true,
            'message' => 'Get friends count success.',
            'code' => 1009,
            'count' => $user->getFriends()
        ]);
    }
}
