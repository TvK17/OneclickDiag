# OneclickDiag
Extension for LibreNMS that provides one click diagnostics on Cisco networking devices.


# Oneclick Device Diagnostics


Installation Instructions:

**These instructions assume you are the root user. If you are not, prepend sudo to the shell commands or temporarily become a user with root privileges**

After logging into your LibreNMS server CLI:

Home dir: <br>
```cd ~/```

Clone repo to your home dir: <br>
```git clone https://github.com/NotTK/Oneclick```

Moving Oneclick.blade.php to correct dir: <br>
```mv Oneclick/Oneclick.blade.php resources/views/device/tabs/```

Moving OneclickController.php to correct dir: <br>
```mv Oneclick/OneclickController.php app/Http/Controllers/Device/Tabs/``` 

Edit the DeviceController.php file: <br>
```vi app/Http/Controller/DeviceController.php```
<br>
<br>
  Using 'vi': <br>
    press 'i' to switch to INSERT mode (Typing Mode) <br>
    press 'esc' to switch to READ mode <br>
    to save file and exit you have to be in READ mode and type ':wq' <br>
    to leave file without saving you have to be in READ mode and type ':q' <br>
    to force leave file without saving you have to be in READ mode and type ':q!' <br>

One you are editing the DeviceController.php file, find the 'private $tabs', <br>
at the bottom after the 'CaptureController::class,' press ENTER to add a new line <br>
(make sure you are in INSERT mode) and type the following: <br>
```'oneclick' => \App\Http\Controllers\Device\Tabs\OneclickController::class,``` 

From there refresh the device page and see the new tab added.

Adding Laravel Route:
```vi routes/web.php``` 
<br>
Add the following code after the "// Device Tabs" comment near line 80
<br>
```
Route::post('/run-python-script', function() {
      try {
          exec('python3 Tester.py', $output, $return_var);

          return response()->json(['output' => $output, 'return_var' => $return_var]);
      } catch (Exception $e) {
          return response()->json(['error' => $e->getMessage()]);
      }
  });
```

<br> 

