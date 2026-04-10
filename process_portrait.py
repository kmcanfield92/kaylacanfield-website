from PIL import Image, ImageEnhance

img = Image.open('/home/ubuntu/kc_site/assets/images/photos/portrait-1.jpg')
w, h = img.size  # 1366 x 1365

# Crop to portrait ratio focused on face/upper body
target_w = 900
target_h = 1100
left = (w - target_w) // 2
top = 0
right = left + target_w
bottom = target_h
cropped = img.crop((left, top, right, bottom))

# Slight warmth and brightness
warm = ImageEnhance.Color(cropped).enhance(1.05)
bright = ImageEnhance.Brightness(warm).enhance(1.03)
bright.save('/home/ubuntu/kc_site/assets/images/photos/portrait-hero.jpg', quality=88, optimize=True)
print(f"portrait-hero.jpg saved: {bright.size}")

# Square crop for avatar use
sq_size = 600
sq_left = (w - sq_size) // 2
sq_top = 40
sq = img.crop((sq_left, sq_top, sq_left + sq_size, sq_top + sq_size))
sq.save('/home/ubuntu/kc_site/assets/images/photos/portrait-square.jpg', quality=85)
print(f"portrait-square.jpg saved: {sq.size}")
