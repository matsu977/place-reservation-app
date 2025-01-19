// components/Header.jsx
import React from 'react';

const Header = () => {
  const handleLogout = (e) => {
    e.preventDefault();
    document.getElementById('logout-form').submit();
  };

  return (
    <nav className="bg-white border-b">
      <div className="container mx-auto px-4">
        <div className="flex justify-between h-16">
          <div className="flex items-center">
            <a href="/dashboard" className="flex items-center">
              <img 
                src="/images/bunchi-logo.png" 
                alt="バンチカンリ" 
                className="h-10 w-auto mr-2"
              />
            </a>
          </div>
          
          <div className="flex items-center">
            <a href="/guide" className="px-3 text-gray-600 hover:text-gray-900">
              使い方
            </a>
            <a 
              href="/mypage" 
              className="px-3 text-gray-600 hover:text-gray-900"
            >
              マイページ
            </a>
          </div>
        </div>
      </div>
    </nav>
  );
};

// components/Footer.jsx
const Footer = () => {
  return (
    <footer className="bg-gray-50 py-4">
      <div className="container mx-auto px-4">
        <p className="text-center text-sm text-gray-600">
          &copy; バンチカンリ All rights reserved.
        </p>
      </div>
    </footer>
  );
};

// components/Layout.jsx
const Layout = ({ children }) => {
  return (
    <div className="min-h-screen flex flex-col">
      <Header />
      <main className="flex-grow">
        <div className="container mx-auto px-4">
          {children}
        </div>
      </main>
      <Footer />
    </div>
  );
};

export { Header, Footer, Layout };