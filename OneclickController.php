<?php


namespace App\Http\Controllers\Device\Tabs;

use App\Models\Device;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use LibreNMS\Interfaces\UI\DeviceTab;

class OneclickController implements DeviceTab {

  use AuthorizesRequests;

  public function visible(Device $device): bool {
    return true;
  }

  public function slug(): string {
    return 'oneclick';
  }

  public function icon(): string {
    return 'fa-file-text-o';
  }

  public function name(): string {
    return __('Oneclick Diagnostics');
  }

  public function data(Device $device): array {
    return [];
  }

  public function executeScript() {
    try {
        exec('python3 Tester.py', $output, $return_var);
        return response()->json(['output' => $output, 'return_var' => $return_var]);
    } catch (\Exception $e) {
        return response()->json(['Error' => $e->getMessage()]);
    }
  }
  
}
