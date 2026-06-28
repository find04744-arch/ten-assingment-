import os

replacements = {
    'aboutus.blade.php': [
        ('themifyicon ti-arrow-top-right', 'flaticon flaticon-botton'),
        ('fa fa-star', 'flaticon flaticon-fabric'),
    ],
    'certifications.blade.php': [
        ('fa fa-search', 'flaticon flaticon-measuring-tape'),
        ('fa fa-random', 'flaticon flaticon-returning'),
    ],
    'career.blade.php': [
        ('ti ti-check', 'flaticon flaticon-textile'),
        ('fa fa-long-arrow-right', 'flaticon flaticon-botton'),
        ('ttm-num ti-info', 'flaticon flaticon-textile-1'),
    ],
    'home.blade.php': [
        ('fa fa-star', 'flaticon flaticon-fabric'),
        ('fa fa-long-arrow-right', 'flaticon flaticon-botton'),
        ('ti ti-check', 'flaticon flaticon-textile'),
        ('ttm-num ti-info', 'flaticon flaticon-textile-1'),
        ('fa fa-search', 'flaticon flaticon-measuring-tape'),
        ('fa fa-random', 'flaticon flaticon-returning'),
    ],
}

base_path = r'e:\Project GIL\Integra-web\resources\views\frontend\pages'

for filename, rules in replacements.items():
    file_path = os.path.join(base_path, filename)
    if not os.path.exists(file_path):
        print(f"File not found: {file_path}")
        continue
        
    try:
        with open(file_path, 'r', encoding='utf-8') as f:
            content = f.read()
            
        new_content = content
        for old, new in rules:
            new_content = new_content.replace(old, new)
            
        if new_content != content:
            with open(file_path, 'w', encoding='utf-8') as f:
                f.write(new_content)
            print(f"Updated {filename}")
        else:
            print(f"No changes for {filename}")
            
    except Exception as e:
        print(f"Error processing {filename}: {e}")

# Also check industries and products folders just in case
extra_dirs = ['industries', 'products']
common_replacements = [
    ('ttm-num ti-info', 'flaticon flaticon-textile-1'),
    ('ti ti-check', 'flaticon flaticon-textile'),
    ('fa fa-long-arrow-right', 'flaticon flaticon-botton'),
    ('fa fa-search', 'flaticon flaticon-measuring-tape'),
    ('fa fa-random', 'flaticon flaticon-returning'),
]

for dir_name in extra_dirs:
    dir_path = os.path.join(base_path, dir_name)
    if not os.path.exists(dir_path):
        continue
        
    for filename in os.listdir(dir_path):
        if filename.endswith('.blade.php'):
            file_path = os.path.join(dir_path, filename)
            try:
                with open(file_path, 'r', encoding='utf-8') as f:
                    content = f.read()
                
                new_content = content
                for old, new in common_replacements:
                    new_content = new_content.replace(old, new)
                    
                if new_content != content:
                    with open(file_path, 'w', encoding='utf-8') as f:
                        f.write(new_content)
                    print(f"Updated {dir_name}/{filename}")
            except Exception as e:
                print(f"Error processing {dir_name}/{filename}: {e}")
