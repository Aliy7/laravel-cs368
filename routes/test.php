use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/send-test-mail', function () {
    Mail::raw('This is a test email', function ($message) {
        $message->to('test@example.com')->subject('Test Email');
    });

    return 'Email sent successfully!';
});

Route::get('/dashboard', [DashboardController::class, 'index']
)->middleware(['auth', 'verified'])->name('dashboard.index');