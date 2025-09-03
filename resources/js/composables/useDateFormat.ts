export function dateFormat(date = '2025-08-25T19:39:29.000000Z'): string {
    const [date_part] = date.split('T');

    return new Date(date_part).toLocaleDateString();
}
