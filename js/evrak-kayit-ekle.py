dogrulama_kod=input("Doğrulama Kodu:")
sayi=input("Sayı:")
url=input("Url:")

def kayitguncelle(dogrulama_kod,sayi,url):
    kayitlar=open("evrak-kayit.csv","a")
    ekle=dogrulama_kod+";"+sayi+";"+url+"\n"
    kayitlar.write(ekle)
    kayitlar.close()
kayitguncelle(dogrulama_kod,sayi,url)