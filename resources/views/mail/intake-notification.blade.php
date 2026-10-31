<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $heading }}</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f1f5f9; color: #172554; font-family: Arial, Helvetica, sans-serif; text-align: left;">
    <div style="display: none; max-height: 0; overflow: hidden; opacity: 0;">
        {{ $heading }} - MediDENT Multicare Clinic
    </div>
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background-color: #f1f5f9; padding: 32px 12px;">
        <tr>
            <td align="center">
                <table role="presentation" width="600" cellspacing="0" cellpadding="0" style="width: 100%; max-width: 600px; overflow: hidden; border-radius: 12px; background-color: #ffffff;">
                    <tr>
                        <td style="padding: 28px 32px; background-color: #0e7490; color: #ffffff;">
                            <p style="margin: 0; font-size: 13px; font-weight: 700; letter-spacing: 1.5px;">MEDIDENT MULTICARE CLINIC</p>
                            <h1 style="margin: 20px 0 8px; font-size: 24px; line-height: 1.3;">{{ $heading }}</h1>
                            <p style="margin: 0; color: #cffafe; font-size: 15px; line-height: 1.6;">{{ $intro }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 28px 32px 32px;">
                            <h2 style="margin: 0 0 16px; color: #0f172a; font-size: 16px;">Request details</h2>
                            <table role="presentation" width="100%" align="left" cellspacing="0" cellpadding="0" style="width: 100%; table-layout: fixed; border-collapse: collapse; text-align: left;">
                                @foreach ($details as $detail)
                                    <tr>
                                        <td align="left" valign="top" style="padding: 12px 14px; border-top: 1px solid #e2e8f0; color: #1e293b; text-align: left !important; vertical-align: top;">
                                            <div style="margin: 0 0 4px; color: #64748b; font-size: 11px; font-weight: 700; line-height: 1.4; letter-spacing: 0.4px; text-align: left !important;">
                                                {{ $detail['label'] }}
                                            </div>
                                            <div style="margin: 0; color: #1e293b; font-size: 14px; line-height: 1.5; word-break: break-word; overflow-wrap: anywhere; white-space: pre-wrap; text-align: left !important;">
                                                {{ $detail['value'] }}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            <p style="margin: 24px 0 0; color: #64748b; font-size: 12px; line-height: 1.6;">
                                This notification was sent automatically from the MediDENT website.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
