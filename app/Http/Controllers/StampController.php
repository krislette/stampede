<?php

/* ======================================================================
SYSTEM NAME: STAMPede
PURPOSE: Controller for stamp creation, display, and management
PROGRAMMER: Acelle Krislette L. Rosales
COPYRIGHT: © 2025 ITD. All rights reserved.
====================================================================== */

namespace App\Http\Controllers;

use App\Models\Stamp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StampController extends Controller
{
    /**
     * Display the wall (READ)
     */
    public function showWall()
    {
        $arrStamps = Stamp::getStampsForWall(10);

        return view('wall', compact('arrStamps'));
    }

    /**
     * Show create stamp form
     */
    public function showCreateForm()
    {
        return view('create_stamp');
    }

    /**
     * Store new stamp (CREATE)
     */
    public function storeStamp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'stp_to' => 'required|string|max:100',
            'stp_from' => 'required|string|max:100',
            'stp_message' => 'required|string',
            'stp_color' => 'required|string|in:sunrays,lime,blaze,hotpink,skyblue,white',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $stamp = new Stamp;
        $stamp->stp_to = $request->stp_to;
        $stamp->stp_from = $request->stp_from;
        $stamp->stp_message = $request->stp_message;
        $stamp->stp_color = $request->stp_color;
        $stamp->stp_edit_code = Stamp::generateEditCode();
        $stamp->save();

        return redirect('/')
            ->with('success', 'Stamp created successfully!')
            ->with('edit_code', $stamp->stp_edit_code);
    }

    /**
     * Show edit form (UPDATE)
     */
    public function showEditForm($intStampId)
    {
        $stamp = Stamp::findOrFail($intStampId);

        return view('edit_stamp', compact('stamp'));
    }

    /**
     * Update stamp
     */
    public function updateStamp(Request $request, $intStampId)
    {
        $stamp = Stamp::findOrFail($intStampId);

        // Check if edit code matches
        if ($request->stp_edit_code !== $stamp->stp_edit_code) {
            return redirect()->back()->with('toast_error', 'Incorrect edit code.');
        }

        $validator = Validator::make($request->all(), [
            'stp_to' => 'required|string|max:100',
            'stp_from' => 'required|string|max:100',
            'stp_message' => 'required|string',
            'stp_color' => 'required|string|in:sunrays,lime,blaze,hotpink,skyblue,white',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $stamp->stp_to = $request->stp_to;
        $stamp->stp_from = $request->stp_from;
        $stamp->stp_message = $request->stp_message;
        $stamp->stp_color = $request->stp_color;
        $stamp->save();

        return redirect('/')->with('success', 'Stamp updated successfully!');
    }

    /**
     * Delete stamp (DELETE)
     */
    public function deleteStamp(Request $request, $intStampId)
    {
        $request->validate([
            'stp_edit_code' => 'required|string',
        ]);

        $stamp = Stamp::findOrFail($intStampId);

        if ($request->stp_edit_code !== $stamp->stp_edit_code) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid delete code!',
            ]);
        }

        $stamp->delete();

        return response()->json([
            'success' => true,
            'message' => 'Stamp deleted successfully!',
        ]);
    }

    /**
     * Load more stamps for infinite scroll
     */
    public function loadMoreStamps(Request $request)
    {
        $intPage = $request->get('page', 1);
        $arrStamps = Stamp::orderBy('created_at', 'desc')->paginate(10, ['*'], 'page', $intPage);

        return response()->json([
            'stamps' => $arrStamps->items(),
            'has_more' => $arrStamps->hasMorePages(),
        ]);
    }
}
