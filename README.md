### **Laravel App Store In-App Purchase Package**
**Version 1.0.0**

Streamline your iOS app's in-app purchase integration with our robust Laravel package. Designed for developers seeking a reliable and easy-to-use solution for handling App Store in-app purchases server-side.

**Key Features:**

- **Seamless Integration**: Easily incorporate App Store in-app purchases into your Laravel application.
- **Receipt Validation**: Securely validate receipts with Apple's servers to prevent fraud.
- **Subscription Management**: Effortlessly handle subscription lifecycles, including renewals and expirations.

**Technical Specifications:**
- Requires Laravel 9.0+
- PHP 8.2 or higher

### **Getting Started**
1. Install via Composer:`composer require ashkanab/laravel-in-app-purchase`
2. Publish the configuration file and migration file: `php artisan vendor:publish --provider="AppStore\InAppPurchase\PurchaseServiceProvider"`
3. Set up your App Store Connect credentials in published config file named purchase.php.
4. (optional) use HasSubscription trait and implement Subscriptionable interface in your user model.