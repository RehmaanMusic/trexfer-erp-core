export default function PoweredByZerp({ className = '' }: { className?: string }) {
    return (
        <p className={`text-center text-xs text-gray-400 dark:text-gray-500 py-3 ${className}`}>
            Powered by{' '}
            <a
                href="https://trexfer.com"
                target="_blank"
                rel="noopener noreferrer"
                className="font-medium text-primary hover:underline"
            >
                Trexfer
            </a>
        </p>
    );
}
