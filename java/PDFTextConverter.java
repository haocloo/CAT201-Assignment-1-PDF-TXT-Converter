import java.io.*;
import org.apache.pdfbox.cos.COSDocument;
import org.apache.pdfbox.pdmodel.PDDocument;
import org.apache.pdfbox.text.PDFTextStripper;
import org.apache.pdfbox.io.RandomAccessFile;
import org.apache.pdfbox.pdfparser.PDFParser;

import org.apache.pdfbox.pdmodel.PDPage;
import org.apache.pdfbox.pdmodel.PDPageContentStream;
import org.apache.pdfbox.pdmodel.font.PDType1Font;

public class PDFTextConverter {
    public static void main(String[] args) {
        try {
            // The filename is passed as a command-line argument
            String filename = args[0];

            // Determine the file extension
            String extension = "";
            int i = filename.lastIndexOf('.');
            if (i > 0) {
                extension = filename.substring(i + 1);
            }

            // Call the appropriate method based on the file extension
            if (extension.equalsIgnoreCase("pdf")) {
                generateTxtFromPDF(filename);
            } else if (extension.equalsIgnoreCase("txt")) {
                generatePDFFromTxt(filename);
            }
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    public static void generateTxtFromPDF(String filename) throws IOException {
        // Loading part
        File f = new File(filename);
        String parsedText;
        PDFParser parser = new PDFParser(new RandomAccessFile(f, "r"));
        parser.parse();

        // Extracting text part
        COSDocument cosDoc = parser.getDocument();
        PDFTextStripper pdfStripper = new PDFTextStripper();
        PDDocument pdDoc = new PDDocument(cosDoc);
        parsedText = pdfStripper.getText(pdDoc);

        // Close all the used streams
        cosDoc.close();
        pdDoc.close();

        // Get the filename without the extension
        String outputFilename = filename.substring(filename.lastIndexOf("/") + 1, filename.lastIndexOf("."));

        // Final file creation
        PrintWriter pw = new PrintWriter("/var/www/html/output/" + outputFilename + ".txt");
        pw.print(parsedText);
        pw.close();
    }

    public static void generatePDFFromTxt(String filename) throws IOException {
        // Get the filename without the extension
        String outputFilename = filename.substring(filename.lastIndexOf("/") + 1, filename.lastIndexOf("."));

        // Create a new PDF document
        PDDocument document = new PDDocument();
        PDPage page = new PDPage();
        document.addPage(page);

        // Create a new content stream
        PDPageContentStream contentStream = new PDPageContentStream(document, page);

        // Set the font and font size
        contentStream.setFont(PDType1Font.HELVETICA, 12);

        // Read the text file
        BufferedReader reader = new BufferedReader(new FileReader(filename));
        String line;
        float margin = 50;
        float yStart = page.getMediaBox().getHeight() - margin;
        float yPosition = yStart;

        // Add each line from the text file to the PDF document
        while ((line = reader.readLine()) != null) {
            contentStream.beginText();
            contentStream.newLineAtOffset(margin, yPosition);
            contentStream.showText(line);
            contentStream.endText();
            yPosition -= 15; // move to next line
        }

        // Close the content stream
        contentStream.close();

        // Save the PDF document
        document.save("/var/www/html/output/" + outputFilename + ".pdf");

        // Close the text file and the PDF document
        reader.close();
        document.close();
    }
}