<?php

return [
    "login" => [
        "username_or_email" => "שם משתמש או כתובת דואר אלקטרוני",
        "forgot_password_link" => "שכחת סיסמה?",
        "create_an_account" => "צור חשבון חדש",
    ],
    "password_confirm" => [
        "heading" => "אימות סיסמה",
        "description" => "אנא אמת את הסיסמה שלך כדי להשלים את הפעולה.",
        "current_password" => "סיסמה נוכחית"
    ],
    "two_factor" => [
        "heading" => "אימות דו שלבי",
        "description" => "אנא אמת כניסה לחשבונך על ידי הזנת קוד אימות מיושם על ידי יישומון האימות.",
        "code_placeholder" => "XXX-XXX",
        "recovery" => [
            "heading" => "אימות דו שלבי",
            "description" => "אנא אמת כניסה לחשבונך על ידי הזנת אחד מקודי השחזור החירום שלך.",
        ],
        "recovery_code_placeholder" => "abcdef-98765",
        "recovery_code_text" => "אבדת את המכשיר?",
        "recovery_code_link" => "השתמש בקודי השחזור",
        "back_to_login_link" => "חזרה למסך הכניסה"
    ],
    "registration" => [
        "title" => "רישום למערכת",
        "heading" => "צור משתמש חדש",
        "submit" => [
            "label" => "הרשם",
        ],
        "notification_unique" => "משתמש עם כתובת דואר זו כבר קיים. אנא התחבר.",
    ],
    "reset_password" => [
        "title" => "איפוס סיסמה",
        "heading" => "איפוס הסיסמה שלך",
        "submit" => [
            "label" => "שלח",
        ],
        "notification_error" => "שגיאה באיפוס הסיסמה. אנא בקש איפוס סיסמה חדש.",
        "notification_error_link_text" => "נסה שוב",
        "notification_success" => "בדוק את תיבת הדואר שלך להוראות!",
    ],
    "verification" => [
        "title" => "אימות אימייל",
        "heading" => "נדרש אימות אימייל",
        "submit" => [
            "label" => "התנתק",
        ],
        "notification_success" => "בדוק את תיבת הדואר שלך להוראות!",
        "notification_resend" => "הודעת האימות נשלחה מחדש.",
        "before_proceeding" => "לפני ההמשך, אנא בדוק את תיבת הדואר שלך לקבלת קישור אימות.",
        "not_receive" => "אם לא קיבלת את ההודעה,",
        "request_another" => "לחץ כאן לבקשה נוספת",
    ],
    "profile" => [
        "account" => "חשבון",
        "profile" => "פרופיל",
        "my_profile" => "הפרופיל שלי",
        "personal_info" => [
            "heading" => "פרטים אישיים",
            "subheading" => "ניהול המידע האישי שלך.",
            "submit" => [
                "label" => "עדכן",
            ],
            "notify" => "פרופיל עודכן בהצלחה!",
        ],
        "password" => [
            "heading" => "סיסמה",
            "subheading" => "חייבת להיות באורך של 8 תווים.",
            "submit" => [
                "label" => "עדכן",
            ],
            "notify" => "סיסמה עודכנה בהצלחה!",
        ],
        "2fa" => [
            "title" => "אימות דו-שלבי",
            "description" => "ניהול אימות דו-שלבי עבור החשבון שלך (מומלץ).",
            "actions" => [
                "enable" => "הפעל",
                "regenerate_codes"=>"צור מחדש קודים",
                "disable"=>"בטל",
                "confirm_finish" => "אישור וסיום",
                "cancel_setup" => "בטל הגדרות"
            ],
            "setup_key" => "מפתח הגדרות",
            "not_enabled" => [
                "title" => "לא הפעלת אימות דו-שלבי.",
                "description"=>"כאשר אימות דו-שלבי מופעל, תקבל בקשה להזין קוד בטוח ואקראי במהלך הכניסה לחשבון. תוכל לקבל את הקוד הזה מיישום Google Authenticator בטלפון שלך."
            ],
            "finish_enabling" => [
                "title"=>"סיים את הפעלת אימות דו-שלבי.",
                "description" => "כדי לסיים את הפעלת אימות דו-שלבי, סרוק את קוד ה-QR הבא באמצעות היישום המתאים בטלפון שלך או הזן את מפתח ההגדרות וספק את קוד ה-OTP המיוצר."
            ],
            "enabled"=>[
                "title"=>"הפעלת אימות דו-שלבי בוצעה בהצלחה!",
                "description"=>"אימות דו-שלבי מופעל כעת. זה יגביל גישה לחשבונך בצורה נוספת ויגביר את האבטחה שלו.",
                "store_codes"=>"שמור על קודי השחזור אלו במנהל סיסמאות מאובטח. הם יכולים לשמש לשחזור גישה לחשבון שלך אם התקן האימות הדו-שלבי יאבד.",
                "show_codes"=>'הצג קודי שחזור',
                "hide_codes" => 'הסתר קודי שחזור'
            ],
            "confirmation" => [
                "success_notification" => 'הקוד אומת. הפעלת אימות דו-שלבי התקבלה בהצלחה.',
                "invalid_code" => "הקוד שהוזן אינו תקף."
            ]
        ],
        "sanctum" => [
            "title" => "טוקנים של API",
            "description" => "ניהול טוקנים של API שמאפשרים לשירותים צד ג' לגשת ליישום זה מבחינתך. הערה: הטוקן מוצג פעם אחת בעת יצירתו. אם תאבד את הטוקן, יהיה עליך למחוקו וליצור טוקן חדש.",
            "create" => [
                "notify" => "הטוקן נוצר בהצלחה!",
                "submit" => [
                    "label" => "יצירה",
                ],
            ],
            "update" => [
                "notify" => "הטוקן עודכן בהצלחה!",
            ],
        ],
    ],
    "fields" => [
        "email" => "אימייל",
        "emails" => "דואר אלקטרוני",
        "login" => "כניסה",
        "name" => "שם",
        "password" => "סיסמה",
        "password_confirm" => "אישור סיסמה",
        "new_password" => "סיסמה חדשה",
        "new_password_confirmation" => "אישור סיסמה",
        "token_name" => "שם הטוקן",
        "abilities" => "יכולות",
        "2fa_code" => "קוד",
        "2fa_recovery_code" => "קוד שחזור"
    ],
    "or" => "או",
    "cancel" => "ביטול"
];
