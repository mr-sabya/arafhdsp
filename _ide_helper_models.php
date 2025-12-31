<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin whereUpdatedAt($value)
 */
	class Admin extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $upazila_id
 * @property string $name
 * @property string|null $bn_name
 * @property string|null $post_code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Upazila $upazila
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Area newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Area newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Area query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Area whereBnName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Area whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Area whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Area whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Area wherePostCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Area whereUpazilaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Area whereUpdatedAt($value)
 */
	class Area extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string|null $bn_name
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BloodGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BloodGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BloodGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BloodGroup whereBnName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BloodGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BloodGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BloodGroup whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BloodGroup whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BloodGroup whereUpdatedAt($value)
 */
	class BloodGroup extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name_en
 * @property string $name_bn
 * @property string $icon
 * @property int $sort_order
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $display_name
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department whereNameBn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department whereUpdatedAt($value)
 */
	class Department extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name_en
 * @property string $name_bn
 * @property int|null $division_id
 * @property int|null $district_id
 * @property int|null $upazila_id
 * @property int|null $area_id
 * @property string|null $address_en
 * @property string|null $address_bn
 * @property string|null $phone
 * @property string|null $photo
 * @property string|null $discount_badge_en
 * @property string|null $discount_badge_bn
 * @property array<array-key, mixed>|null $test_list
 * @property int $sort_order
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Area|null $area
 * @property-read \App\Models\District|null $district
 * @property-read \App\Models\Division|null $division
 * @property-read mixed $display_address
 * @property-read mixed $display_badge
 * @property-read mixed $display_name
 * @property-read \App\Models\Upazila|null $upazila
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DiagnosticCenter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DiagnosticCenter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DiagnosticCenter query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DiagnosticCenter whereAddressBn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DiagnosticCenter whereAddressEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DiagnosticCenter whereAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DiagnosticCenter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DiagnosticCenter whereDiscountBadgeBn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DiagnosticCenter whereDiscountBadgeEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DiagnosticCenter whereDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DiagnosticCenter whereDivisionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DiagnosticCenter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DiagnosticCenter whereNameBn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DiagnosticCenter whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DiagnosticCenter wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DiagnosticCenter wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DiagnosticCenter whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DiagnosticCenter whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DiagnosticCenter whereTestList($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DiagnosticCenter whereUpazilaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DiagnosticCenter whereUpdatedAt($value)
 */
	class DiagnosticCenter extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $division_id
 * @property string $name
 * @property string|null $bn_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Division $division
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Upazila> $upazilas
 * @property-read int|null $upazilas_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|District newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|District newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|District query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|District whereBnName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|District whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|District whereDivisionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|District whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|District whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|District whereUpdatedAt($value)
 */
	class District extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string|null $bn_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\District> $districts
 * @property-read int|null $districts_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Division newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Division newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Division query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Division whereBnName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Division whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Division whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Division whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Division whereUpdatedAt($value)
 */
	class Division extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $department_id
 * @property string $name_en
 * @property string $name_bn
 * @property string|null $designation_en
 * @property string|null $designation_bn
 * @property string|null $degree_en
 * @property string|null $degree_bn
 * @property numeric $base_fee
 * @property int $discount_percentage
 * @property string|null $discount_badge_en
 * @property string|null $discount_badge_bn
 * @property string|null $bio_en
 * @property string|null $bio_bn
 * @property string|null $photo
 * @property string|null $appointment_number
 * @property int $sort_order
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Department $department
 * @property-read mixed $discounted_fee
 * @property-read mixed $display_badge
 * @property-read mixed $display_degree
 * @property-read mixed $display_designation
 * @property-read mixed $display_name
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Doctor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Doctor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Doctor query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Doctor whereAppointmentNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Doctor whereBaseFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Doctor whereBioBn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Doctor whereBioEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Doctor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Doctor whereDegreeBn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Doctor whereDegreeEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Doctor whereDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Doctor whereDesignationBn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Doctor whereDesignationEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Doctor whereDiscountBadgeBn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Doctor whereDiscountBadgeEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Doctor whereDiscountPercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Doctor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Doctor whereNameBn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Doctor whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Doctor wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Doctor whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Doctor whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Doctor whereUpdatedAt($value)
 */
	class Doctor extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name_en
 * @property string $name_bn
 * @property string|null $address_en
 * @property string|null $address_bn
 * @property string|null $phone
 * @property string|null $photo
 * @property int|null $division_id
 * @property int|null $district_id
 * @property int|null $upazila_id
 * @property int|null $area_id
 * @property array<array-key, mixed>|null $benefits
 * @property int $sort_order
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Area|null $area
 * @property-read \App\Models\District|null $district
 * @property-read \App\Models\Division|null $division
 * @property-read mixed $display_address
 * @property-read mixed $display_name
 * @property-read \App\Models\Upazila|null $upazila
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hospital newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hospital newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hospital query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hospital whereAddressBn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hospital whereAddressEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hospital whereAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hospital whereBenefits($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hospital whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hospital whereDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hospital whereDivisionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hospital whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hospital whereNameBn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hospital whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hospital wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hospital wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hospital whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hospital whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hospital whereUpazilaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hospital whereUpdatedAt($value)
 */
	class Hospital extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $type
 * @property string|null $account_number
 * @property string|null $qr_code
 * @property string|null $instruction
 * @property string|null $driver
 * @property array<array-key, mixed>|null $config
 * @property bool $status
 * @property int $sort_order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $qr_image_url
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod whereAccountNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod whereConfig($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod whereDriver($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod whereInstruction($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod whereQrCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod whereUpdatedAt($value)
 */
	class PaymentMethod extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $level_text
 * @property numeric $price
 * @property string $billing_interval
 * @property string $pricing_type
 * @property int $discount_percentage
 * @property array<array-key, mixed>|null $pricing_rules
 * @property array<array-key, mixed> $features
 * @property bool $is_featured
 * @property string|null $ribbon_text
 * @property int $sort_order
 * @property bool $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $interval_bn
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PricingPlan active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PricingPlan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PricingPlan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PricingPlan query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PricingPlan whereBillingInterval($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PricingPlan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PricingPlan whereDiscountPercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PricingPlan whereFeatures($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PricingPlan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PricingPlan whereIsFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PricingPlan whereLevelText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PricingPlan whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PricingPlan wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PricingPlan wherePricingRules($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PricingPlan wherePricingType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PricingPlan whereRibbonText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PricingPlan whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PricingPlan whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PricingPlan whereUpdatedAt($value)
 */
	class PricingPlan extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $slug
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereUpdatedAt($value)
 */
	class Role extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $district_id
 * @property string $name
 * @property string|null $bn_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Area> $areas
 * @property-read int|null $areas_count
 * @property-read \App\Models\District $district
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Upazila newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Upazila newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Upazila query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Upazila whereBnName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Upazila whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Upazila whereDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Upazila whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Upazila whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Upazila whereUpdatedAt($value)
 */
	class Upazila extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int|null $role_id
 * @property string $name
 * @property string|null $father_name
 * @property string $mobile
 * @property \Illuminate\Support\Carbon|null $dob
 * @property int|null $blood_group_id
 * @property string|null $nid
 * @property string|null $photo
 * @property int|null $division_id
 * @property int|null $district_id
 * @property int|null $upazila_id
 * @property int|null $area_id
 * @property int|null $pricing_plan_id
 * @property string|null $package_level
 * @property int $family_members
 * @property numeric $total_price
 * @property string|null $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $otp
 * @property \Illuminate\Support\Carbon|null $otp_expires_at
 * @property bool $is_verified
 * @property string $payment_status
 * @property string $application_status
 * @property string|null $transaction_id
 * @property string|null $payment_method
 * @property string|null $nominee_name
 * @property string|null $nominee_relation
 * @property \Illuminate\Support\Carbon|null $subscription_expires_at
 * @property \Illuminate\Support\Carbon|null $last_payment_date
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Area|null $area
 * @property-read \App\Models\BloodGroup|null $bloodGroup
 * @property-read \App\Models\District|null $district
 * @property-read \App\Models\Division|null $division
 * @property-read mixed $commission_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\PricingPlan|null $pricingPlan
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $referrals
 * @property-read int|null $referrals_count
 * @property-read User|null $referrer
 * @property-read \App\Models\Role|null $role
 * @property-read \App\Models\Upazila|null $upazila
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User referredBy($workerId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereApplicationStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereBloodGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereDivisionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereDob($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereFamilyMembers($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereFatherName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereIsVerified($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereLastPaymentDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereNid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereNomineeName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereNomineeRelation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereOtp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereOtpExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePackageLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePricingPlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereSubscriptionExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereTotalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpazilaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

